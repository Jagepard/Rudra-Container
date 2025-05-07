<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Closure;
use Rudra\Container\{
    Interfaces\RudraInterface,
    Traits\InstantiationsTrait,
    Interfaces\FactoryInterface,
};
use Psr\Container\{
    ContainerInterface, 
    NotFoundExceptionInterface, 
    ContainerExceptionInterface,
}; 
use ReflectionClass;
use ReflectionMethod;
use ReflectionException;
use BadMethodCallException;
use InvalidArgumentException;

/**
 * @method waiting()
 * @method binding()
 * @method services()
 */
class Rudra implements RudraInterface, ContainerInterface
{
    use InstantiationsTrait;

    public static ?RudraInterface $rudra = null;

    protected array $allowedContainers = [
        'waiting', 'binding', 'services', 'shared', 'config'
    ];

    protected array $allowedInstances = [
        'request'  => Request::class,
        'response' => Response::class,
        'cookie'   => Cookie::class,
        'session'  => Session::class
    ];

    /**
     * Initializes a service or creates a container
     * --------------------------------------------
     * Инициализирует сервис или создает контейнер
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     * @throws ReflectionException
     */
    public function __call(string $method, array $parameters = [])
    {
        return match (true) {
            in_array($method, $this->allowedContainers) => $this->containerize(
                $method, 
                Container::class, 
                $parameters ? $parameters[0] : $parameters
            ),
            array_key_exists($method, $this->allowedInstances) => $this->init($this->allowedInstances[$method]),
            default => throw new BadMethodCallException("Rudra\Container\Rudra::$method method does not exist")
        };
    }

    /**
     * Creates an object without adding to the container
     * -------------------------------------------------
     * Создает объект без добавления в контейнер
     *
     * @param  string $object
     * @param  array|null $params
     * @return object
     * @throws ReflectionException
     */
    public function new(string $object, ?array $params = null): object
    {
        $reflection = new ReflectionClass($object);
        return ($constructor = $reflection->getConstructor()) && $constructor->getNumberOfParameters()
            ? $reflection->newInstanceArgs($this->getParamsIoC($constructor, $params))
            : new $object();
    }

    /**
     * Creates the main application singleton
     * --------------------------------------
     * Создает основной синглтон приложения
     *
     * @return RudraInterface
     */
    public static function run(): RudraInterface
    {
        return static::$rudra instanceof static 
            ? static::$rudra 
            : static::$rudra = new static();
    }

    /**
     * Gets a service by id, or an array of services if no id is specified
     * ---------------------------------------------------------------------
     * Получает сервис по id или массив сервисов, если id не указан
     *
     * @param  string|null $id
     * @return mixed
     * @throws ReflectionException
     */
    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            if (!$this->waiting()->has($id)) {
                if (class_exists($id)) {
                    $this->waiting()->set([$id => $id]);
                } else {
                    throw new class("Service '$id' is not installed") extends NotFoundExceptionInterface {};
                }
            }

            $waiting = $this->waiting()->get($id);

            if ($waiting instanceof Closure) {
                return $waiting();
            }

            $this->set([$id, $waiting]);
        }

        return $this->services()->get($id);
    }
    
    /**
     * Adds a service to an application
     * --------------------------------
     * Добавляет сервис в приложение
     *
     * @param  array $data
     * @return void
     * @throws ReflectionException
     */
    public function set(array $data): void
    {
        [$k, $obj] = $data;
        !is_string($k) && throw new InvalidArgumentException("Key must be string");

        $this->setObjByType($k, $obj);
    }

    /**
     * @param string $k
     * @param mixed  $obj
     * @return void
     */
    private function setObjByType(string $k, mixed $obj): void
    {
        $extObj = is_array($obj) ? $obj[0] : $obj;
        $isArr  = is_array($obj);

        match (true) {
            $isArr && isset($obj[1]) && !is_object($extObj) => $this->iOc($k, ...$obj),
            is_string($extObj) && class_exists($extObj) && in_array(FactoryInterface::class, class_implements($extObj)) =>
                $this->setObject($k, (new $extObj())->create()),
            $extObj instanceof FactoryInterface => $this->setObject($k, $extObj->create()),
            $extObj instanceof Closure => $this->setObject($k, $extObj()),
            default => $this->setObject($k, $extObj)
        };
    }

    /**
     * Checks for the existence of a service
     * -------------------------------------
     * Проверяет наличие сервиса
     *
     * @param  string  $key
     * @return boolean
     */
    public function has(string $id): bool
    {
        return $this->services()->has($id);
    }

    /**
     * Sets an object
     * --------------
     * Устанавливает объект
     *
     * @param  string $key
     * @param  string|object $object
     * @return void
     * @throws ReflectionException
     */
    private function setObject(string $key, string|object $object): void
    {
        (is_object($object)) ? $this->services()->set([$key => $object]) : $this->iOc($key, $object);
    }

    /**
     * Creates an object using inversion of control
     * --------------------------------------------
     * Создает объект при помощи инверсии контроля
     *
     * @param string $key
     * @param string $object
     * @param array|null $params
     * @return void
     * @throws ReflectionException
     */
    private function iOc(string $key, string $object, ?array $params = null): void
    {
        $reflection = new ReflectionClass($object);
        $this->services()->set([$key => ($c = $reflection->getConstructor()) && $c->getNumberOfParameters()
            ? $reflection->newInstanceArgs($this->getParamsIoC($c, $params))
            : new $object()
        ]);
    }

    /**
     * Calls a method using inversion of control
     * -------------------------------------------
     * Вызывает метод при помощи инверсии контроля
     *
     * @param $object
     * @param string $method
     * @param array|null $params
     * @return mixed|void
     * @throws ReflectionException
     */
    public function autowire($object, string $method, ?array $params = null)
    {
        $rm = new ReflectionMethod($object, $method);
        return $rm->getNumberOfParameters() 
            ? $rm->invokeArgs($object, $this->getParamsIoC($rm, $params)) 
            : null;
    }

    /**
     * Gets parameters using inversion of control
     * ------------------------------------------
     * Получает параметры при помощи инверсии контроля
     *
     * @param ReflectionMethod $constructor
     * @param array|null $params
     * @return array
     * @throws ReflectionException
     */
    private function getParamsIoC(ReflectionMethod $constructor, ?array $params): array
    {
        $params = (array)$params === $params ? $params : [$params];
        $i = 0;
        $result = [];
    
        foreach ($constructor->getParameters() as $param) {
            $type = $param->getType()?->getName();
    
            if ($type && $this->binding()->has($type)) {
                $class = $this->binding()->get($type);
                $result[] = match(true) {
                    $class instanceof Closure => $class(),
                    is_string($class) && str_contains($class, 'Factory') => (new $class)->create(),
                    is_object($class) => $class,
                    $this->waiting()->has($class) => ($service = $this->get($class)) instanceof Closure ? $service() : $service,
                    default => new $class
                };
                continue;
            }
    
            $result[] = match(true) {
                $type && class_exists($type) => new $type,
                $param->isDefaultValueAvailable() && !isset($params[$i]) => $param->getDefaultValue(),
                default => $params[$i++]
            };
        }
    
        return $result;
    }
}
