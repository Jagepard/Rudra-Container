<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Closure;
use ReflectionClass;
use ReflectionMethod;
use Rudra\Exceptions\{
    LogicException, 
    NotFoundException
};
use Rudra\Container\{
    Interfaces\RudraInterface,
    Traits\InstantiationsTrait,
    Interfaces\FactoryInterface,
};
use Psr\Container\ContainerInterface; 

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

    /**
     * Handles dynamic method calls for the class.
     * If the method exists in `allowedContainersMap`, it initializes a container 
     * with the provided data and returns it.
     * If the method exists in `allowedInstances`, it initializes and returns 
     * the corresponding instance.
     * If the method is not allowed (not found in either map), it throws a LogicException.
     * -------------------------
     * Обрабатывает динамические вызовы методов для класса.
     * Если метод существует в `allowedContainersMap`, инициализирует контейнер 
     * с предоставленными данными и возвращает его.
     * Если метод существует в `allowedInstances`, инициализирует и возвращает 
     * соответствующий экземпляр.
     * Если метод не разрешён (не найден ни в одной из карт), выбрасывается исключение LogicException.
     *
     * @param  string $method
     * @param  array  $parameters
     * @return void
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
    
        throw new LogicException("{$method}' is not allowed.");
    }

    /**
     * Implements the Singleton pattern to ensure only one instance of the class is created.
     * If the instance does not exist, it creates and stores it. Otherwise, it returns the existing instance.
     * -------------------------
     * Реализует паттерн Singleton, чтобы гарантировать создание только одного экземпляра класса.
     * Если экземпляр не существует, он создаётся и сохраняется. В противном случае возвращается существующий экземпляр.
     *
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
     * Retrieves a service by its ID from the service container or waiting storage.
     * If the service exists in the container, it is returned directly.
     * If the service does not exist, it checks if the service can be resolved from the waiting storage or class name.
     * If the service cannot be resolved, it throws a NotFoundException.
     * -------------------------
     * Извлекает сервис по его идентификатору из контейнера сервисов или хранилища ожидания.
     * Если сервис существует в контейнере, он возвращается напрямую.
     * Если сервис не существует, проверяется, может ли он быть разрешён из хранилища ожидания или имени класса.
     * Если сервис не может быть разрешён, выбрасывается исключение NotFoundException.
     *
     * @param  string $id
     * @return mixed
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
     * Sets a value or object in the container, identified by a key.
     * If the key is not a string, it throws a LogicException.
     * If the object is an array, it processes the array using `handleArrayObject`.
     * Otherwise, it resolves and sets the object using `resolveSetValue` and `setObject`.
     * -------------------------
     * Устанавливает значение или объект в контейнере, идентифицированный ключом.
     * Если ключ не является строкой, выбрасывается исключение LogicException.
     * Если объект является массивом, он обрабатывается с помощью `handleArrayObject`.
     * В противном случае объект разрешается и устанавливается с помощью `resolveSetValue` и `setObject`.
     *
     * @param  array $data
     * @return void
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
     * -------------------------
     * Обрабатывает массив объектов во время процесса установки.
     * Если массив содержит более одного элемента, и первый элемент не является объектом, 
     * он обрабатывает массив с использованием внедрения зависимостей через метод `iOc`.
     * В противном случае разрешает и устанавливает первый элемент как значение для указанного ключа.
     *
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
     * Resolves the value to be set in the container based on its type.
     * If the value is a Closure, it executes and returns the result.
     * If the value is a string matching the factory naming convention (ends with "Factory") and the class exists,
     * it instantiates the class and calls its `create()` method.
     * Otherwise, it returns the value as-is.
     * -------------------------
     * Разрешает значение, которое должно быть установлено в контейнере, на основе его типа.
     * Если значение является замыканием (Closure), оно выполняется, и возвращается результат.
     * Если значение — строка, соответствующая соглашению об именовании фабрик (оканчивается на "Factory"),
     * и класс существует, создаётся его экземпляр и вызывается метод `create()`.
     * В противном случае значение возвращается без изменений.
     *
     * @param  mixed $value
     * @return mixed
     */
    private function resolveSetValue(mixed $value): mixed
    {
        if ($value instanceof Closure) {
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
     * -------------------------
     * Проверяет, представляет ли данное значение допустимую реализацию интерфейса FactoryInterface.
     * Значение считается допустимым, если оно является строкой, класс существует и является подклассом FactoryInterface.
     *
     * @param  mixed $value
     * @return boolean
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
    public function has(string $id): bool
    {
        return $this->services()->has($id);
    }

    /**
     * Sets an object or class in the service container.
     * If the provided value is an object, it is directly stored in the service container.
     * If the provided value is a string (class name), it resolves and sets the object using the `iOc` method.
     * -------------------------
     * Устанавливает объект или класс в контейнере сервисов.
     * Если предоставленное значение является объектом, он сохраняется напрямую в контейнере сервисов.
     * Если предоставленное значение является строкой (имя класса), разрешается и устанавливается объект с использованием метода `iOc`.
     *
     * @param  string        $key
     * @param  string|object $object
     * @return void
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
     * -------------------------
     * Разрешает и устанавливает объект в контейнере сервисов с использованием внедрения зависимостей.
     * Использует рефлексию для анализа конструктора указанного класса.
     * Если конструктор имеет параметры, они разрешаются с помощью `getParamsIoC`, и экземпляр создаётся с использованием разрешённых аргументов.
     * Если конструктор не имеет параметров, экземпляр создаётся напрямую.
     * Созданный экземпляр затем сохраняется в контейнере сервисов с указанным ключом.
     *
     * @param  string     $key
     * @param  string     $object
     * @param  array|null $params
     * @return void
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
     * Creates and returns a new instance of the specified class.
     * If the class has a constructor with parameters, it resolves and injects them using the provided parameters.
     * If the class does not exist, it throws a LogicException.
     * -------------------------
     * Создаёт и возвращает новый экземпляр указанного класса.
     * Если у класса есть конструктор с параметрами, разрешает их и внедряет, используя предоставленные параметры.
     * Если класс не существует, выбрасывается исключение LogicException.
     *
     * @param  string     $object
     * @param  array|null $params
     * @return object
     */
    public function new(string $object, ?array $params = null): object
    {
        if (!class_exists($object)) {
            throw new LogicException("Class {$object} does not exist");
        }

        $reflection  = new ReflectionClass($object);
        $constructor = $reflection->getConstructor();

        if ($constructor && $constructor->getNumberOfParameters() > 0) {
            $args = $this->getParamsIoC($constructor, $params);
            return $reflection->newInstanceArgs($args);
        }

        return $reflection->newInstanceWithoutConstructor();
    }

    /**
     * Automatically resolves and invokes a method on the given object using dependency injection.
     * It uses reflection to analyze the method's parameters and resolves them using `getParamsIoC`.
     * If the method has no parameters, it is invoked directly. Otherwise, the resolved arguments are passed during invocation.
     * -------------------------
     * Автоматически разрешает и вызывает метод у указанного объекта с использованием внедрения зависимостей.
     * Использует рефлексию для анализа параметров метода и разрешает их с помощью `getParamsIoC`.
     * Если метод не имеет параметров, он вызывается напрямую. В противном случае разрешённые аргументы передаются при вызове.
     *
     * @param  $object
     * @param  string     $method
     * @param  array|null $params
     * @return mixed
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
     * Resolves and retrieves parameters for dependency injection based on the constructor's reflection.
     * It processes each parameter of the constructor, resolving dependencies using bindings, class names, or default values.
     * If a parameter cannot be resolved, it uses the provided `$params` array.
     * -------------------------
     * Разрешает и извлекает параметры для внедрения зависимостей на основе рефлексии конструктора.
     * Обрабатывает каждый параметр конструктора, разрешая зависимости с использованием привязок, имён классов или значений по умолчанию.
     * Если параметр не может быть разрешён, используется предоставленный массив `$params`.
     *
     * @param  ReflectionMethod $constructor
     * @param  array|null       $params
     * @return array
     */
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

    /**
     * Resolves a dependency based on the provided class name or object.
     * If the dependency is a Closure, it executes and returns the result.
     * If the dependency is an object, it resolves the object using `resolveObject`.
     * If the dependency exists in the waiting storage, it retrieves and resolves the service recursively.
     * If the dependency is a string representing an existing class, it resolves the class using `resolveClass`.
     * Otherwise, it creates and returns a new instance of the class.
     * -------------------------
     * Разрешает зависимость на основе предоставленного имени класса или объекта.
     * Если зависимость является замыканием (Closure), оно выполняется, и возвращается результат.
     * Если зависимость является объектом, разрешает объект с помощью `resolveObject`.
     * Если зависимость существует в хранилище ожидания, извлекает и разрешает сервис рекурсивно.
     * Если зависимость является строкой, представляющей существующий класс, разрешает класс с помощью `resolveClass`.
     * В противном случае создаётся и возвращается новый экземпляр класса.
     *
     * @param  $className
     * @return object
     */
    private function resolveDependency($className): object
    {
        if ($className instanceof Closure) {
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
     * -------------------------
     * Разрешает класс, создавая его экземпляр.
     * Если класс реализует или является подклассом `FactoryInterface`, создаётся экземпляр, и вызывается метод `create`.
     * В противном случае просто создаётся и возвращается новый экземпляр класса.
     *
     * @param  string $className
     * @return object
     */
    private function resolveClass(string $className): object
    {
        // Включить поддержку интерфейсов: третий аргумент = true
        if (is_subclass_of($className, FactoryInterface::class, true)) {
            return (new $className())->create();
        }

        return $this->new($className);
    }

    /**
     * Resolves an object by checking if it implements the FactoryInterface.
     * If the object implements FactoryInterface, it calls the `create` method and returns the result.
     * Otherwise, it returns the object as-is.
     * -------------------------
     * Разрешает объект, проверяя, реализует ли он интерфейс FactoryInterface.
     * Если объект реализует FactoryInterface, вызывается метод `create`, и возвращается результат.
     * В противном случае объект возвращается без изменений.
     *
     * @param  object $object
     * @return object
     */
    private function resolveObject(object $object): object
    {
        if ($object instanceof FactoryInterface) {
            return $object->create();
        }

        return $object;
    }
}
