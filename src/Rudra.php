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
use RuntimeException;
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
    protected array $reflectionCache  = [];
    protected array $constructorCache = [];
    protected array $resolvedClasses  = [];

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
     * @param  string $object
     * @param  array|null $params
     * @return object
     * @throws ReflectionException
     */
    public function new(string $object, ?array $params = null): object
    {
        if (!class_exists($object)) {
            throw new RuntimeException("Class {$object} does not exist");
        }

        if (!isset($this->reflectionCache[$object])) {
            $reflection = new ReflectionClass($object);
            $constructor = $reflection->getConstructor();
            $this->reflectionCache[$object] = [
                'reflection' => $reflection,
                'has_constructor_params' => $constructor && $constructor->getNumberOfParameters() > 0,
            ];
        }

        $cached = $this->reflectionCache[$object];

        if (!$cached['has_constructor_params']) {
            return $cached['reflection']->newInstanceWithoutConstructor();
        }

        $args = $this->getParamsIoC($cached['reflection']->getConstructor(), $params);

        return $cached['reflection']->newInstanceArgs($args);
    }

    /**
     * @return RudraInterface
     */
    public static function run(): RudraInterface
    {
        if (!isset(static::$rudra)) {
            static::$rudra = new static();
        }

        return static::$rudra;
    }

    /**
     * @param  string|null $id
     * @return mixed
     * @throws ReflectionException
     */
    public function get(string $id): mixed
    {
        if ($this->has($id)) {
            return $this->services()->get($id);
        }

        $waitingStorage = $this->waiting();

        if (!$waitingStorage->has($id)) {
            if (!class_exists($id)) {
                throw new NotFoundException("Service '$id' is not installed");
            }
            $waitingStorage->set([$id => $id]);
        }

        $waiting = $waitingStorage->get($id);

        if ($waiting instanceof Closure) {
            return $waiting();
        }

        $this->set([$id, $waiting]);

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

        $this->setObject($key, $this->resolveSetValue($object));
    }

    /**
     * @param  string $key
     * @param  array  $object
     * @return void
     */
    private function handleArrayObject(string $key, array $object): void
    {
        $first = $object[0];

        if (count($object) > 1 && !is_object($first)) {
            $args = array_slice($object, 1);
            $this->iOc($key, $first, ...$args);
            return;
        }

        $this->setObject($key, $this->resolveSetValue($first));
    }
    
    /**
     * @param  $value
     * @return mixed
     */
    private function resolveSetValue($value): mixed
    {
        if ($value instanceof Closure) {
            return $value();
        }

        if (is_string($value)) {
            if (class_exists($value, false)) {
                if (is_subclass_of($value, FactoryInterface::class, false)) {
                    return (new $value())->create();
                }
                if (str_contains($value, 'Factory')) {
                    return (new $value)->create();
                }
            }
        }

        return $value;
    }

    /**
     * @param  string  $key
     * @return boolean
     */
    public function has(string $id): bool
    {
        return $this->services()->has($id);
    }

    /**
     * @param  string $key
     * @param  string|object $object
     * @return void
     * @throws ReflectionException
     */
    private function setObject(string $key, string|object $object): void
    {
        if (is_object($object)) {
            $this->services()->set([$key => $object]);
        } else {
            $this->iOc($key, $object);
        }
    }
    
    /**
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

        if ($constructor && $constructor->getNumberOfParameters() > 0) {
            $args     = $this->getParamsIoC($constructor, $params);
            $instance = $reflection->newInstanceArgs($args);
        } else {
            $instance = new $object();
        }

        $this->services()->set([$key => $instance]);
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
    public function autowire($object, string $method, ?array $params = null): mixed
    {
        $reflectionMethod = new ReflectionMethod($object, $method);

        if ($reflectionMethod->getNumberOfParameters() === 0) {
            return $reflectionMethod->invoke($object);
        }

        $arguments = $this->getParamsIoC($reflectionMethod, $params);
        
        return $reflectionMethod->invokeArgs($object, $arguments);
    }

    /**
     * @param ReflectionMethod $constructor
     * @param array|null $params
     * @return array
     * @throws ReflectionException
     */
    private function getParamsIoC(ReflectionMethod $constructor, ?array $params): array
    {
        $class  = $constructor->getDeclaringClass()->getName();
        $method = $constructor->getName();

        $cacheKey = "$class::$method";

        if (!isset($this->constructorCache[$cacheKey])) {
            $this->constructorCache[$cacheKey] = iterator_to_array($constructor->getParameters());
        }

        $parameters = $this->constructorCache[$cacheKey];
        $params     = is_array($params) ? array_values($params) : [$params];

        $i = 0;
        $paramsIoC = [];

        foreach ($parameters as $value) {
            $type = $value->getType()?->getName();

            if ($type && $this->binding()->has($type)) {
                $className   = $this->binding()->get($type);
                $paramsIoC[] = $this->resolveDependency($className);
                continue;
            }

            if ($type && class_exists($type)) {
                $paramsIoC[] = $this->resolveClass($type);
                continue;
            }

            if ($value->isDefaultValueAvailable() && !isset($params[$i])) {
                $paramsIoC[] = $value->getDefaultValue();
                $i++;
                continue;
            }

            $paramsIoC[] = $params[$i++];
        }

        return $paramsIoC;
    }

    /**
     * @param  $className
     * @return void
     */
    private function resolveDependency($className)
    {
        if ($className instanceof Closure) {
            return $className();
        }

        if (is_string($className) && class_exists($className)) {
            return $this->resolveClass($className);
        }

        if (is_object($className)) {
            return $this->resolveObject($className);
        }

        if ($this->waiting()->has($className)) {
            $service = $this->get($className);
            return $this->resolveDependency($service);
        }

        return new $className;
    }

    /**
     * @param  string $className
     * @return void
     */
    private function resolveClass(string $className)
    {
        if (is_subclass_of($className, FactoryInterface::class)) {
            return (new $className())->create();
        }

        if (str_contains($className, 'Factory')) {
            return (new $className)->create();
        }

        return new $className;
    }

    /**
     * @param  $object
     * @return void
     */
    private function resolveObject($object)
    {
        if ($object instanceof FactoryInterface) {
            return $object->create();
        }

        if (str_contains(get_class($object), 'Factory')) {
            return $object->create();
        }

        return $object;
    }
}
