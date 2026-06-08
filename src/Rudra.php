<?php declare(strict_types=1);

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
 */

namespace Rudra\Container;

use Rudra\Exceptions\LogicException;
use Rudra\Exceptions\NotFoundException;
use Rudra\Container\Interfaces\RudraInterface;
use Rudra\Container\Traits\InstantiationsTrait;
use Rudra\Container\Interfaces\FactoryInterface;
use Psr\Container\ContainerInterface; 

/**
 * @method waiting() Returns a container for temporary data
 * @method binding() Returns a container for bindings
 * @method services() Returns a container for services
 */
class Rudra implements RudraInterface, ContainerInterface
{
    use InstantiationsTrait;

    public static ?RudraInterface $rudra = null;

    protected readonly array $allowedContainersMap;
    protected readonly array $allowedInstances;

    public function __construct()
    {
        $this->allowedContainersMap = [
            'waiting'  => true,
            'binding'  => true,
            'services' => true,
            'shared'   => true,
            'config'   => true
        ];
        $this->allowedInstances = [
            'request'  => Request::class,
            'response' => Response::class,
            'cookie'   => Cookie::class,
            'session'  => Session::class
        ];
    }

    /**
     * Handles dynamic method calls for the class.
     * If the method exists in `allowedContainersMap`, it initializes a container.
     * with the provided data and returns it.
     * If the method exists in `allowedInstances`, it initializes and returns.
     * the corresponding instance.
     * If the method is not allowed (not found in either map), it throws a LogicException.
     */
    public function __call(string $method, array $parameters = []): mixed
    {
        if (isset($this->allowedContainersMap[$method])) {
            $data = $parameters[0] ?? [];
            return $this->containerize($method, Container::class, $data);
        }
    
        if (isset($this->allowedInstances[$method])) {
            return $this->init($this->allowedInstances[$method]);
        }
    
        throw new LogicException("Method '{$method}' is not allowed.");
    }

    /**
     * Implements the Singleton pattern to ensure only one instance of the class is created.
     * If the instance does not exist, it creates and stores it. Otherwise, it returns the existing instance.
     */
    #[\Override]
    public static function run(): RudraInterface
    {
        if (!isset(static::$rudra)) {
            static::$rudra = new static();
        }

        return static::$rudra;
    }

    /**
     * Retrieves a service by its ID from the service container or waiting storage.
     * If the service exists in the container, it is returned directly.
     * If the service does not exist, it checks if the service can be resolved from the waiting storage or class name.
     * If the service cannot be resolved, it throws a NotFoundException.
     */
    #[\Override]
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

        if ($waiting instanceof \Closure) {
            return $waiting();
        }

        $this->set([$id, $waiting]);

        return $this->services()->get($id);
    }

    /**
     * Sets a value or object in the container, identified by a key.
     * If the key is not a string, it throws a LogicException.
     * If the object is an array, it processes the array using `handleArrayObject`.
     * Otherwise, it resolves and sets the object using `resolveSetValue` and `setObject`.
     */
    public function set(array $data): void
    {
        [$key, $object] = $data;

        if (!is_string($key)) {
            throw new LogicException("Key must be a string");
        }

        if (is_array($object)) {
            $this->handleArrayObject($key, $object);
            return;
        }

        $this->setObject($key, $this->resolveSetValue($object));
    }

    /**
     * Handles the processing of an array object during the setting process.
     * If the array contains more than one element and the first element is not an object, 
     * it processes the array using dependency injection via the `iOc` method.
     * Otherwise, it resolves and sets the first element as the value for the given key.
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
     * Resolves the value to be set in the container based on its type.
     * If the value is a Closure, it executes and returns the result.
     * If the value is a string matching the factory naming convention (ends with "Factory") and the class exists,
     * it instantiates the class and calls its `create()` method.
     * Otherwise, it returns the value as-is.
     */
    private function resolveSetValue(mixed $value): mixed
    {
        if ($value instanceof \Closure) {
            return $value();
        }

        if ($this->isFactoryImplementation($value)) {
            return (new $value())->create();
        }

        return $value;
    }

    /**
     * Checks if the given value represents a valid implementation of the FactoryInterface.
     * The value is considered valid if it is a string, the class exists, and it is a subclass of FactoryInterface.
     */
    private function isFactoryImplementation(mixed $value): bool
    {
        return is_string($value)
            && class_exists($value, false)
            && is_subclass_of($value, FactoryInterface::class, false);
    }

    /**
     * @param  string  $id
     * @return boolean
     */
    #[\Override]
    public function has(string $id): bool
    {
        return $this->services()->has($id);
    }

    /**
     * Sets an object or class in the service container.
     * If the provided value is an object, it is directly stored in the service container.
     * If the provided value is a string (class name), it resolves and sets the object using the `iOc` method.
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
     * Resolves and sets an object in the service container using dependency injection.
     * It uses reflection to analyze the constructor of the specified class.
     * If the constructor has parameters, it resolves them using `getParamsIoC` and creates the instance with the resolved arguments.
     * If the constructor has no parameters, it creates the instance directly.
     * The created instance is then stored in the service container with the specified key.
     */
    private function iOc(string $key, string $object, ?array $params = null): void
    {
        $reflection  = new \ReflectionClass($object);
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
     * Creates and returns a new instance of the specified class.
     * If the class has a constructor with parameters, it resolves and injects them using the provided parameters.
     * If the class does not exist, it throws a LogicException.
     */
    public function new(string $object, ?array $params = null): object
    {
        if (!class_exists($object)) {
            throw new LogicException("Class {$object} does not exist");
        }

        $reflection  = new \ReflectionClass($object);
        $constructor = $reflection->getConstructor();

        if ($constructor && $constructor->getNumberOfParameters() > 0) {
            $args = $this->getParamsIoC($constructor, $params);
            return $reflection->newInstanceArgs($args);
        }

        return new $object();
    }

    /**
     * Automatically resolves and invokes a method on the given object using dependency injection.
     * It uses reflection to analyze the method's parameters and resolves them using `getParamsIoC`.
     * If the method has no parameters, it is invoked directly. Otherwise, the resolved arguments are passed during invocation.
     */
    public function autowire(object|string$object, string $method, ?array $params = null): mixed
    {
        $reflectionMethod = new \ReflectionMethod($object, $method);

        if ($reflectionMethod->getNumberOfParameters() === 0) {
            return $reflectionMethod->invoke($object);
        }

        $arguments = $this->getParamsIoC($reflectionMethod, $params);
        
        return $reflectionMethod->invokeArgs($object, $arguments);
    }

    /**
     * Resolves and retrieves parameters for dependency injection based on the constructor's reflection.
     * It processes each parameter of the constructor, resolving dependencies using bindings, class names, or default values.
     */
    public function getParamsIoC(\ReflectionMethod $constructor, ?array $params): array
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

    /**
     * Resolves a dependency based on the provided class name or object.
     * If the dependency is a Closure, it executes and returns the result.
     * If the dependency is an object, it resolves the object using `resolveObject`.
     * If the dependency exists in the waiting storage, it retrieves and resolves the service recursively.
     * If the dependency is a string representing an existing class, it resolves the class using `resolveClass`.
     * Otherwise, it creates and returns a new instance of the class.
     */
    private function resolveDependency($className): object
    {
        if ($className instanceof \Closure) {
            return $className();
        }

        if (is_object($className)) {
            return $this->resolveObject($className);
        }

        if ($this->waiting()->has($className)) {
            $service = $this->get($className);
            return $this->resolveDependency($service);
        }

        if (is_string($className) && class_exists($className)) {
            return $this->resolveClass($className);
        }

        return $this->new($className);
    }

    /**
     * Resolves a class by creating an instance of it.
     * If the class implements or is a subclass of `FactoryInterface`, it creates an instance and calls the `create` method.
     * Otherwise, it simply creates and returns a new instance of the class.
     */
    private function resolveClass(string $className): object
    {
        if (is_subclass_of($className, FactoryInterface::class, true)) {
            return (new $className())->create();
        }

        return $this->new($className);
    }

    /**
     * Resolves an object by checking if it implements the FactoryInterface.
     * If the object implements FactoryInterface, it calls the `create` method and returns the result.
     * Otherwise, it returns the object as-is.
     */
    private function resolveObject(object $object): object
    {
        if ($object instanceof FactoryInterface) {
            return $object->create();
        }

        return $object;
    }
}
