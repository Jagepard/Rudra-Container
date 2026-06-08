## Table of contents
- [Rudra\Container\Container](#rudra_container_container)
- [Rudra\Container\Cookie](#rudra_container_cookie)
- [Rudra\Container\Facades\Cookie](#rudra_container_facades_cookie)
- [Rudra\Container\Facades\Request](#rudra_container_facades_request)
- [Rudra\Container\Facades\Response](#rudra_container_facades_response)
- [Rudra\Container\Facades\Rudra](#rudra_container_facades_rudra)
- [Rudra\Container\Facades\Session](#rudra_container_facades_session)
- [Rudra\Container\Interfaces\FactoryInterface](#rudra_container_interfaces_factoryinterface)
- [Rudra\Container\Interfaces\RequestInterface](#rudra_container_interfaces_requestinterface)
- [Rudra\Container\Interfaces\ResponseInterface](#rudra_container_interfaces_responseinterface)
- [Rudra\Container\Interfaces\RudraInterface](#rudra_container_interfaces_rudrainterface)
- [Rudra\Container\Request](#rudra_container_request)
- [Rudra\Container\Response](#rudra_container_response)
- [Rudra\Container\Rudra](#rudra_container_rudra)
- [Rudra\Container\Session](#rudra_container_session)
- [Rudra\Container\Traits\FacadeTrait](#rudra_container_traits_facadetrait)
- [Rudra\Container\Traits\InstantiationsTrait](#rudra_container_traits_instantiationstrait)
- [Rudra\Container\Traits\SetRudraContainersTrait](#rudra_container_traits_setrudracontainerstrait)


---



<a id="rudra_container_container"></a>

### Class: Rudra\Container\Container
| Visibility | Function |
|:-----------|:---------|
| public | `__construct(array $data)`<br> |
| public | `get(string $id): mixed`<br> |
| public | `all(): array`<br> |
| public | `set(array $data): void`<br> |
| public | `has(string $id): bool`<br> |


<a id="rudra_container_cookie"></a>

### Class: Rudra\Container\Cookie
| Visibility | Function |
|:-----------|:---------|
| public | `get(string $id): mixed`<br> |
| public | `has(string $id): bool`<br> |
| public | `remove(string $id): void`<br> |
| private | `deleteCookie(string $id): void`<br> |
| public | `set(string $key, string $value, int $expire, string $path, ?string $domain, bool $secure, bool $httponly, string $samesite): void`<br> |


<a id="rudra_container_facades_cookie"></a>

### Class: Rudra\Container\Facades\Cookie
| Visibility | Function |
|:-----------|:---------|
| public static | `__callStatic(string $method, array $parameters): mixed`<br>Handles static method calls for the Facade class<br>It dynamically resolves the underlying class name by removing "Facade" from the class name<br>If the resolved class does not exist, it attempts to clean up the class name by removing spaces<br>If the resolved class is not already registered in the container, it registers it<br>Finally, it delegates the static method call to the resolved class instance |


<a id="rudra_container_facades_request"></a>

### Class: Rudra\Container\Facades\Request
| Visibility | Function |
|:-----------|:---------|
| public static | `__callStatic(string $method, array $parameters): mixed`<br>Handles static method calls for the Facade class<br>It dynamically resolves the underlying class name by removing "Facade" from the class name<br>If the resolved class does not exist, it attempts to clean up the class name by removing spaces<br>If the resolved class is not already registered in the container, it registers it<br>Finally, it delegates the static method call to the resolved class instance |


<a id="rudra_container_facades_response"></a>

### Class: Rudra\Container\Facades\Response
| Visibility | Function |
|:-----------|:---------|
| public static | `__callStatic(string $method, array $parameters): mixed`<br>Handles static method calls for the Facade class<br>It dynamically resolves the underlying class name by removing "Facade" from the class name<br>If the resolved class does not exist, it attempts to clean up the class name by removing spaces<br>If the resolved class is not already registered in the container, it registers it<br>Finally, it delegates the static method call to the resolved class instance |


<a id="rudra_container_facades_rudra"></a>

### Class: Rudra\Container\Facades\Rudra
| Visibility | Function |
|:-----------|:---------|
| public static | `__callStatic($method, array $parameters)`<br> |


<a id="rudra_container_facades_session"></a>

### Class: Rudra\Container\Facades\Session
| Visibility | Function |
|:-----------|:---------|
| public static | `__callStatic(string $method, array $parameters): mixed`<br>Handles static method calls for the Facade class<br>It dynamically resolves the underlying class name by removing "Facade" from the class name<br>If the resolved class does not exist, it attempts to clean up the class name by removing spaces<br>If the resolved class is not already registered in the container, it registers it<br>Finally, it delegates the static method call to the resolved class instance |


<a id="rudra_container_interfaces_factoryinterface"></a>

### Class: Rudra\Container\Interfaces\FactoryInterface
| Visibility | Function |
|:-----------|:---------|
| abstract public | `create(): object`<br> |


<a id="rudra_container_interfaces_requestinterface"></a>

### Class: Rudra\Container\Interfaces\RequestInterface
| Visibility | Function |
|:-----------|:---------|
| abstract public | `get(): Psr\Container\ContainerInterface`<br> |
| abstract public | `post(): Psr\Container\ContainerInterface`<br> |
| abstract public | `put(): Psr\Container\ContainerInterface`<br> |
| abstract public | `patch(): Psr\Container\ContainerInterface`<br> |
| abstract public | `delete(): Psr\Container\ContainerInterface`<br> |
| abstract public | `server(): Psr\Container\ContainerInterface`<br> |
| abstract public | `files(): Psr\Container\ContainerInterface`<br> |


<a id="rudra_container_interfaces_responseinterface"></a>

### Class: Rudra\Container\Interfaces\ResponseInterface
| Visibility | Function |
|:-----------|:---------|
| abstract public | `json(array $data): void`<br> |


<a id="rudra_container_interfaces_rudrainterface"></a>

### Class: Rudra\Container\Interfaces\RudraInterface
| Visibility | Function |
|:-----------|:---------|
| abstract public static | `run(): Rudra\Container\Interfaces\RudraInterface`<br> |


<a id="rudra_container_request"></a>

### Class: Rudra\Container\Request
| Visibility | Function |
|:-----------|:---------|
| public | `get(): Psr\Container\ContainerInterface`<br> |
| public | `post(): Psr\Container\ContainerInterface`<br> |
| public | `put(): Psr\Container\ContainerInterface`<br> |
| public | `patch(): Psr\Container\ContainerInterface`<br> |
| public | `delete(): Psr\Container\ContainerInterface`<br> |
| public | `server(): Psr\Container\ContainerInterface`<br> |
| public | `files(): Psr\Container\ContainerInterface`<br> |
| private | `containerize(string $name, string $instance, array $data): Psr\Container\ContainerInterface`<br>Creates and stores a container instance if it does not already exist<br>If the container for the given name does not exist in the `containers` array,<br>it creates a new instance of the specified class with the provided data and stores it<br>Otherwise, it returns the existing container instance |
| private | `init(string $name, ?string $instance, array $data): mixed`<br>Initializes and retrieves an instance of a class or service<br>If the instance is not already registered in the container, it registers it with the provided data<br>The method uses the class name as the default instance if no specific instance is provided |


<a id="rudra_container_response"></a>

### Class: Rudra\Container\Response
| Visibility | Function |
|:-----------|:---------|
| public | `json(array $data, int $code): void`<br> |
| private | `getJson(array $data): string`<br> |


<a id="rudra_container_rudra"></a>

### Class: Rudra\Container\Rudra
| Visibility | Function |
|:-----------|:---------|
| public | `__construct()`<br> |
| public | `__call(string $method, array $parameters): mixed`<br>Handles dynamic method calls for the class.<br>If the method exists in `allowedContainersMap`, it initializes a container.<br>with the provided data and returns it.<br>If the method exists in `allowedInstances`, it initializes and returns.<br>the corresponding instance.<br>If the method is not allowed (not found in either map), it throws a LogicException. |
| public static | `run(): Rudra\Container\Interfaces\RudraInterface`<br>Implements the Singleton pattern to ensure only one instance of the class is created.<br>If the instance does not exist, it creates and stores it. Otherwise, it returns the existing instance. |
| public | `get(string $id): mixed`<br>Retrieves a service by its ID from the service container or waiting storage.<br>If the service exists in the container, it is returned directly.<br>If the service does not exist, it checks if the service can be resolved from the waiting storage or class name.<br>If the service cannot be resolved, it throws a NotFoundException. |
| public | `set(array $data): void`<br>Sets a value or object in the container, identified by a key.<br>If the key is not a string, it throws a LogicException.<br>If the object is an array, it processes the array using `handleArrayObject`.<br>Otherwise, it resolves and sets the object using `resolveSetValue` and `setObject`. |
| private | `handleArrayObject(string $key, array $object): void`<br>Handles the processing of an array object during the setting process.<br>If the array contains more than one element and the first element is not an object,<br>it processes the array using dependency injection via the `iOc` method.<br>Otherwise, it resolves and sets the first element as the value for the given key. |
| private | `resolveSetValue(mixed $value): mixed`<br>Resolves the value to be set in the container based on its type.<br>If the value is a Closure, it executes and returns the result.<br>If the value is a string matching the factory naming convention (ends with "Factory") and the class exists,<br>it instantiates the class and calls its `create()` method.<br>Otherwise, it returns the value as-is. |
| private | `isFactoryImplementation(mixed $value): bool`<br>Checks if the given value represents a valid implementation of the FactoryInterface.<br>The value is considered valid if it is a string, the class exists, and it is a subclass of FactoryInterface. |
| public | `has(string $id): bool`<br> |
| private | `setObject(string $key, object\|string $object): void`<br>Sets an object or class in the service container.<br>If the provided value is an object, it is directly stored in the service container.<br>If the provided value is a string (class name), it resolves and sets the object using the `iOc` method. |
| private | `iOc(string $key, string $object, ?array $params): void`<br>Resolves and sets an object in the service container using dependency injection.<br>It uses reflection to analyze the constructor of the specified class.<br>If the constructor has parameters, it resolves them using `getParamsIoC` and creates the instance with the resolved arguments.<br>If the constructor has no parameters, it creates the instance directly.<br>The created instance is then stored in the service container with the specified key. |
| public | `new(string $object, ?array $params): object`<br>Creates and returns a new instance of the specified class.<br>If the class has a constructor with parameters, it resolves and injects them using the provided parameters.<br>If the class does not exist, it throws a LogicException. |
| public | `autowire(object\|string $object, string $method, ?array $params): mixed`<br>Automatically resolves and invokes a method on the given object using dependency injection.<br>It uses reflection to analyze the method's parameters and resolves them using `getParamsIoC`.<br>If the method has no parameters, it is invoked directly. Otherwise, the resolved arguments are passed during invocation. |
| public | `getParamsIoC(ReflectionMethod $constructor, ?array $params): array`<br>Resolves and retrieves parameters for dependency injection based on the constructor's reflection.<br>It processes each parameter of the constructor, resolving dependencies using bindings, class names, or default values. |
| private | `resolveDependency($className): object`<br>Resolves a dependency based on the provided class name or object.<br>If the dependency is a Closure, it executes and returns the result.<br>If the dependency is an object, it resolves the object using `resolveObject`.<br>If the dependency exists in the waiting storage, it retrieves and resolves the service recursively.<br>If the dependency is a string representing an existing class, it resolves the class using `resolveClass`.<br>Otherwise, it creates and returns a new instance of the class. |
| private | `resolveClass(string $className): object`<br>Resolves a class by creating an instance of it.<br>If the class implements or is a subclass of `FactoryInterface`, it creates an instance and calls the `create` method.<br>Otherwise, it simply creates and returns a new instance of the class. |
| private | `resolveObject(object $object): object`<br>Resolves an object by checking if it implements the FactoryInterface.<br>If the object implements FactoryInterface, it calls the `create` method and returns the result.<br>Otherwise, it returns the object as-is. |
| private | `containerize(string $name, string $instance, array $data): Psr\Container\ContainerInterface`<br>Creates and stores a container instance if it does not already exist<br>If the container for the given name does not exist in the `containers` array,<br>it creates a new instance of the specified class with the provided data and stores it<br>Otherwise, it returns the existing container instance |
| private | `init(string $name, ?string $instance, array $data): mixed`<br>Initializes and retrieves an instance of a class or service<br>If the instance is not already registered in the container, it registers it with the provided data<br>The method uses the class name as the default instance if no specific instance is provided |


<a id="rudra_container_session"></a>

### Class: Rudra\Container\Session
| Visibility | Function |
|:-----------|:---------|
| public | `get(string $id): mixed`<br> |
| public | `set(string $key, mixed $value): void`<br> |
| public | `has(string $id): bool`<br> |
| public | `remove(string $key): void`<br> |
| public | `start(): void`<br> |
| public | `stop(): void`<br> |
| public | `clear(): void`<br> |


<a id="rudra_container_traits_facadetrait"></a>

### Class: Rudra\Container\Traits\FacadeTrait
| Visibility | Function |
|:-----------|:---------|
| public static | `__callStatic(string $method, array $parameters): mixed`<br>Handles static method calls for the Facade class<br>It dynamically resolves the underlying class name by removing "Facade" from the class name<br>If the resolved class does not exist, it attempts to clean up the class name by removing spaces<br>If the resolved class is not already registered in the container, it registers it<br>Finally, it delegates the static method call to the resolved class instance |


<a id="rudra_container_traits_instantiationstrait"></a>

### Class: Rudra\Container\Traits\InstantiationsTrait
| Visibility | Function |
|:-----------|:---------|
| private | `containerize(string $name, string $instance, array $data): Psr\Container\ContainerInterface`<br>Creates and stores a container instance if it does not already exist<br>If the container for the given name does not exist in the `containers` array,<br>it creates a new instance of the specified class with the provided data and stores it<br>Otherwise, it returns the existing container instance |
| private | `init(string $name, ?string $instance, array $data): mixed`<br>Initializes and retrieves an instance of a class or service<br>If the instance is not already registered in the container, it registers it with the provided data<br>The method uses the class name as the default instance if no specific instance is provided |


<a id="rudra_container_traits_setrudracontainerstrait"></a>

### Class: Rudra\Container\Traits\SetRudraContainersTrait
| Visibility | Function |
|:-----------|:---------|
| public | `__construct(Rudra\Container\Interfaces\RudraInterface $rudra)`<br> |
| public | `rudra(): Rudra\Container\Interfaces\RudraInterface`<br> |


---

###### created with [Rudra-Documentation-Collector](https://github.com/Jagepard/Rudra-Documentation-Collector)
