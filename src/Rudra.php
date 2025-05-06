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
    Interfaces\ContainerInterface
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
        if (in_array($method, $this->allowedContainers)) {
            $data = (count($parameters)) ? $parameters[0] : $parameters;
            return $this->containerize($method, Container::class, $data);
        }

        if (array_key_exists($method, $this->allowedInstances)) {
            return $this->init($this->allowedInstances[$method]);
        }

        throw new BadMethodCallException("The Rudra\Container\Rudra::$method being called does not exist");
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
        $constructor = $reflection->getConstructor();

        if ($constructor && $constructor->getNumberOfParameters()) {
            $paramsIoC = $this->getParamsIoC($constructor, $params);

            return $reflection->newInstanceArgs($paramsIoC);
        }

        return new $object();
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
        if (!static::$rudra instanceof static) {
            static::$rudra = new static();
        }

        return static::$rudra;
    }

    /**
     * Gets a service by key, or an array of services if no key is specified
     * ---------------------------------------------------------------------
     * Получает сервис по ключу или массив сервисов, если ключ не указан
     *
     * @param  string|null $key
     * @return mixed
     * @throws ReflectionException
     */
    public function get(string $key = null): mixed
    {
        if (isset($key) && !$this->has($key)) {
            if (!$this->waiting()->has($key)) {
                if (class_exists($key)) {
                    $this->waiting()->set([$key => $key]);
                } else {
                    throw new InvalidArgumentException("Service '$key' is not installed");
                }
            }

            $waiting = $this->waiting()->get($key);

            if ($waiting instanceof Closure) {
                return $waiting();
            }

            $this->set([$key, $waiting]);
        }

        if (empty($key)) {
            return $this->services();
        }

        return $this->services()->get($key);
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
        list($key, $object) = $data;

        if (is_array($object)) {
            if (array_key_exists(1, $object) && !is_object($object[0])) {
                $this->iOc($key, $object[0], $object[1]);
                return;
            }

            if (is_string($object[0]) && str_contains($object[0], 'Factory')) {
                $this->setObject($key, (new $object[0])->create());
                return;
            }

            $this->setObject($key, $object[0]);
            return;
        }

        if (is_string($object) && str_contains($object, 'Factory')) {
            $this->setObject($key, (new $object)->create());
            return;
        }

        $this->setObject($key, $object);
    }

    /**
     * Checks for the existence of a service
     * -------------------------------------
     * Проверяет наличие сервиса
     *
     * @param  string  $key
     * @return boolean
     */
    public function has(string $key): bool
    {
        return $this->services()->has($key);
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
        $reflection  = new ReflectionClass($object);
        $constructor = $reflection->getConstructor();

        if ($constructor && $constructor->getNumberOfParameters()) {
            $paramsIoC = $this->getParamsIoC($constructor, $params);

            $this->services()->set([$key => $reflection->newInstanceArgs($paramsIoC)]);
            return;
        }

        $this->services()->set([$key => new $object()]);
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
        $reflectionMethod = new ReflectionMethod($object, $method);

        if ($reflectionMethod->getNumberOfParameters()) {
            $paramsIoC = $this->getParamsIoC($reflectionMethod, $params);

            return $reflectionMethod->invokeArgs($object, $paramsIoC);
        }
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
        $i = 0;
        $paramsIoC = [];
        $params = (is_array($params) && array_key_exists(0, $params)) ? $params : [$params];

        foreach ($constructor->getParameters() as $value) {
            /*
             | If in the constructor expects the implementation of interface,
             | so that the container automatically created the necessary object and substituted as an argument,
             | we need to bind the interface with the implementation.
             */
            if (null !== $value->getType()?->getName() && $this->binding()->has($value->getType()->getName())) {
                $className = $this->binding()->get($value->getType()->getName());

                if ($className instanceof Closure) {
                    $paramsIoC[] = $className();
                    continue;
                }

                if (is_string($className) && str_contains($className, 'Factory')) {
                    $paramsIoC[] = (new $className)->create();
                    continue;
                }

                if (is_object($className)) {
                    $paramsIoC[] = $className;
                } elseif ($this->waiting()->has($className)) {
                    $service     = $this->get($className);
                    $paramsIoC[] = ($service instanceof Closure) ? $service() : $service;
                } else {
                    $paramsIoC[] = new $className;
                }
                continue;
            } elseif (null !== $value->getType()?->getName()) {
                $className = $value->getType()->getName();

                if (class_exists($className)) {
                    $paramsIoC[] = new $className;
                    continue;
                }
            }

            /*
             | If the class constructor contains arguments with default values,
             | then if no arguments are passed,
             | values will be added by default by container
             */
            if ($value->isDefaultValueAvailable() && !isset($params[$i])) {
                $paramsIoC[] = $value->getDefaultValue();
                continue;
            }

            $paramsIoC[] = $params[$i++];
        }

        return $paramsIoC;
    }
}
