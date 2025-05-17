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
use Rudra\Container\Exceptions\NotFoundException;

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

    protected array $allowedContainersMap;

    protected array $reflectionCache = [];

    public function __construct()
    {
        $this->allowedContainersMap = array_flip($this->allowedContainers);
    }

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
        if (isset($this->allowedContainersMap[$method])) {
            $data = $parameters[0] ?? [];
            return $this->containerize($method, Container::class, $data);
        }
    
        if (isset($this->allowedInstances[$method])) {
            return $this->init($this->allowedInstances[$method]);
        }
    
        throw new BadMethodCallException("...");
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
        if (!isset($this->reflectionCache[$object])) {
            $reflection = new ReflectionClass($object);
            $constructor = $reflection->getConstructor();
            $this->reflectionCache[$object] = [
                'reflection' => $reflection,
                'has_constructor_params' => $constructor && $constructor->getNumberOfParameters(),
            ];
        }
    
        $cached = $this->reflectionCache[$object];

        return $cached['has_constructor_params']
            ? $cached['reflection']->newInstanceArgs($this->getParamsIoC($cached['reflection']->getConstructor(), $params))
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
                    throw new NotFoundException("Service '$id' is not installed");
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
     * @param array $data
     * @return void
     * @throws ReflectionException
     */
    public function set(array $data): void
    {
        [$key, $object] = $data;

        if (!is_string($key)) {
            throw new InvalidArgumentException("Key must be a string");
        }

        if (is_array($object)) {
            $this->handleArrayObject($key, $object);
            return;
        }

        // Closure — самый частый случай?
        if ($object instanceof Closure) {
            $this->setObject($key, $object());
            return;
        }

        // Поддержка FactoryInterface через is_subclass_of
        if (is_string($object) && class_exists($object, false)) {
            if (is_subclass_of($object, FactoryInterface::class, false)) {
                $this->setObject($key, (new $object())->create());
                return;
            }
        }

        // Legacy: строка с 'Factory'
        if (is_string($object) && str_contains($object, 'Factory')) {
            $this->setObject($key, (new $object)->create());
            return;
        }

        // Дефолт
        $this->setObject($key, $object);
    }

    /**
     * @param string $key
     * @param array  $object
     * @return void
     */
    private function handleArrayObject(string $key, array $object): void
    {
        $first = $object[0];

        // iOc — если есть второй параметр и первый не объект
        if (count($object) > 1 && !is_object($first)) {
            $args = array_slice($object, 1);
            $this->iOc($key, $first, ...$args);
            return;
        }

        // Closure
        if ($first instanceof Closure) {
            $this->setObject($key, $first());
            return;
        }

        // Поддержка FactoryInterface
        if (is_string($first) && class_exists($first, false)) {
            if (is_subclass_of($first, FactoryInterface::class, false)) {
                $this->setObject($key, (new $first())->create());
                return;
            }
        }

        // Legacy: строка с 'Factory'
        if (is_string($first) && str_contains($first, 'Factory')) {
            $this->setObject($key, (new $first)->create());
            return;
        }

        // Дефолт
        $this->setObject($key, $first);
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
        $i = 0;
        $paramsIoC = [];
        $params = (is_array($params) && array_key_exists(0, $params)) ? $params : [$params];
    
        foreach ($constructor->getParameters() as $value) {
            $type = $value->getType()?->getName();

            if ($type && $this->binding()->has($type)) {
                $className = $this->binding()->get($type);

                if ($className instanceof Closure) {
                    $paramsIoC[] = $className();
                } elseif (is_string($className) && class_exists($className)) {
                    // Поддержка FactoryInterface
                    if (is_subclass_of($className, FactoryInterface::class)) {
                        $paramsIoC[] = (new $className())->create();
                    // Legacy: строка с 'Factory'
                    } elseif (str_contains($className, 'Factory')) {
                        $paramsIoC[] = (new $className)->create();
                    } else {
                        $paramsIoC[] = new $className;
                    }
                } elseif (is_object($className)) {
                    // Проверка на FactoryInterface
                    if ($className instanceof FactoryInterface) {
                        $paramsIoC[] = $className->create();
                    } else {
                        $paramsIoC[] = $className;
                    }
                } elseif ($this->waiting()->has($className)) {
                    $service = $this->get($className);
                    if ($service instanceof Closure) {
                        $paramsIoC[] = $service();
                    } elseif ($service instanceof FactoryInterface) {
                        $paramsIoC[] = $service->create();
                    } else {
                        $paramsIoC[] = $service;
                    }
                } else {
                    $paramsIoC[] = new $className;
                }

                continue;
            }
    
            if ($type && class_exists($type)) {
                // Поддержка FactoryInterface через is_subclass_of
                if (is_subclass_of($type, FactoryInterface::class)) {
                    $paramsIoC[] = (new $type())->create();
                // Legacy: строка с 'Factory'
                } elseif (str_contains($type, 'Factory')) {
                    $paramsIoC[] = (new $type)->create();
                } else {
                    $paramsIoC[] = new $type;
                }
                continue;
            }
    
            if ($value->isDefaultValueAvailable() && !isset($params[$i])) {
                $paramsIoC[] = $value->getDefaultValue();
                continue;
            }
    
            $paramsIoC[] = $params[$i++];
        }
    
        return $paramsIoC;
    }
}
