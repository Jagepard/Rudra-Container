<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Closure;
use Rudra\Container\{
    Interfaces\RudraInterface,
    Traits\InstantiationsTrait,
    Interfaces\FactoryInterface,
    Exceptions\NotFoundException,
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

/**
 * @method waiting() Возвращает контейнер для временных данных (waiting).
 * @method binding() Возвращает контейнер для связываний (binding).
 * @method services() Возвращает контейнер для сервисов (services).
 */
class Rudra implements RudraInterface, ContainerInterface
{
    use InstantiationsTrait;

    public static ?RudraInterface $rudra = null;

    protected array $allowedContainersMap = [
        'waiting'  => true,
        'binding'  => true,
        'services' => true,
        'shared'   => true,
        'config'   => true
    ];

    protected array $allowedInstances = [
        'request'  => Request::class,
        'response' => Response::class,
        'cookie'   => Cookie::class,
        'session'  => Session::class
    ];

    public function __call(string $method, array $parameters = [])
    {
        if (isset($this->allowedContainersMap[$method])) {
            $data = $parameters[0] ?? [];
            return $this->containerize($method, Container::class, $data);
        }
    
        if (isset($this->allowedInstances[$method])) {
            return $this->init($this->allowedInstances[$method]);
        }
    
        throw new LogicException("{$method}' is not allowed.");
    }

    public function new(string $object, ?array $params = null): object
    {
        if (!class_exists($object)) {
            throw new RuntimeException("Class {$object} does not exist");
        }

        $reflection  = new ReflectionClass($object);
        $constructor = $reflection->getConstructor();

        if ($constructor && $constructor->getNumberOfParameters() > 0) {
            $args = $this->getParamsIoC($constructor, $params);
            return $reflection->newInstanceArgs($args);
        }

        return $reflection->newInstanceWithoutConstructor();
    }

    public static function run(): RudraInterface
    {
        if (!isset(static::$rudra)) {
            static::$rudra = new static();
        }

        return static::$rudra;
    }

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
    
    private function resolveSetValue($value): mixed
    {
        if ($value instanceof Closure) {
            return $value();
        }

        if ($this->isFactoryImplementation($value)) {
            return (new $value())->create();
        }

        return $value;
    }

    private function isFactoryImplementation($value): bool
    {
        return is_string($value)
            && class_exists($value, false)
            && is_subclass_of($value, FactoryInterface::class, false);
    }

    public function has(string $id): bool
    {
        return $this->services()->has($id);
    }

    private function setObject(string $key, string|object $object): void
    {
        if (is_object($object)) {
            $this->services()->set([$key => $object]);
        } else {
            $this->iOc($key, $object);
        }
    }
    
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

    public function autowire($object, string $method, ?array $params = null): mixed
    {
        $reflectionMethod = new ReflectionMethod($object, $method);

        if ($reflectionMethod->getNumberOfParameters() === 0) {
            return $reflectionMethod->invoke($object);
        }

        $arguments = $this->getParamsIoC($reflectionMethod, $params);
        
        return $reflectionMethod->invokeArgs($object, $arguments);
    }

    public function getParamsIoC(ReflectionMethod $constructor, ?array $params): array
    {
        $i         = 0;
        $params    = is_array($params) ? array_values($params) : [$params];
        $paramsIoC = [];

        foreach ($constructor->getParameters() as $value) {
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

    private function resolveDependency($className): object
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

    private function resolveClass(string $className): object
    {
        if (is_subclass_of($className, FactoryInterface::class)) {
            return (new $className())->create();
        }

        return new $className;
    }

    private function resolveObject(object $object): object
    {
        if ($object instanceof FactoryInterface) {
            return $object->create();
        }

        return $object;
    }
}
