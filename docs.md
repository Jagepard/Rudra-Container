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
<hr>

<a id="rudra_container_container"></a>

### Class: Rudra\Container\Container
| Visibility | Function |
|:-----------|:---------|
| public | `__construct(array $data)`<br> |
| public | `get(string $id): ?mixed`<br> |
| public | `all(): array`<br> |
| public | `set(array $data): void`<br> |
| public | `has(string $id): bool`<br> |


<a id="rudra_container_cookie"></a>

### Class: Rudra\Container\Cookie
| Visibility | Function |
|:-----------|:---------|
| public | `get(string $id): ?mixed`<br> |
| public | `has(string $id): bool`<br> |
| public | `unset(string $id): void`<br> |
| private | `deleteCookie(string $id): void`<br> |
| public | `set(array $data): void`<br> |
| private | `processCookieData(array $data): void`<br> |


<a id="rudra_container_facades_cookie"></a>

### Class: Rudra\Container\Facades\Cookie
| Visibility | Function |
|:-----------|:---------|
| public static | `__callStatic(string $method, array $parameters): ?mixed`<br>Handles static method calls for the Facade class.<br>It dynamically resolves the underlying class name by removing "Facade" from the class name.<br>If the resolved class does not exist, it attempts to clean up the class name by removing spaces.<br>If the resolved class is not already registered in the container, it registers it.<br>Finally, it delegates the static method call to the resolved class instance.<br>-------------------------<br>Обрабатывает статические вызовы методов для класса Facade.<br>Динамически разрешает имя базового класса, удаляя "Facade" из имени класса.<br>Если разрешённый класс не существует, пытается очистить имя класса, удаляя пробелы.<br>Если разрешённый класс ещё не зарегистрирован в контейнере, он регистрируется.<br>В конце делегирует статический вызов метода экземпляру разрешённого класса. |


<a id="rudra_container_facades_request"></a>

### Class: Rudra\Container\Facades\Request
| Visibility | Function |
|:-----------|:---------|
| public static | `__callStatic(string $method, array $parameters): ?mixed`<br>Handles static method calls for the Facade class.<br>It dynamically resolves the underlying class name by removing "Facade" from the class name.<br>If the resolved class does not exist, it attempts to clean up the class name by removing spaces.<br>If the resolved class is not already registered in the container, it registers it.<br>Finally, it delegates the static method call to the resolved class instance.<br>-------------------------<br>Обрабатывает статические вызовы методов для класса Facade.<br>Динамически разрешает имя базового класса, удаляя "Facade" из имени класса.<br>Если разрешённый класс не существует, пытается очистить имя класса, удаляя пробелы.<br>Если разрешённый класс ещё не зарегистрирован в контейнере, он регистрируется.<br>В конце делегирует статический вызов метода экземпляру разрешённого класса. |


<a id="rudra_container_facades_response"></a>

### Class: Rudra\Container\Facades\Response
| Visibility | Function |
|:-----------|:---------|
| public static | `__callStatic(string $method, array $parameters): ?mixed`<br>Handles static method calls for the Facade class.<br>It dynamically resolves the underlying class name by removing "Facade" from the class name.<br>If the resolved class does not exist, it attempts to clean up the class name by removing spaces.<br>If the resolved class is not already registered in the container, it registers it.<br>Finally, it delegates the static method call to the resolved class instance.<br>-------------------------<br>Обрабатывает статические вызовы методов для класса Facade.<br>Динамически разрешает имя базового класса, удаляя "Facade" из имени класса.<br>Если разрешённый класс не существует, пытается очистить имя класса, удаляя пробелы.<br>Если разрешённый класс ещё не зарегистрирован в контейнере, он регистрируется.<br>В конце делегирует статический вызов метода экземпляру разрешённого класса. |


<a id="rudra_container_facades_rudra"></a>

### Class: Rudra\Container\Facades\Rudra
| Visibility | Function |
|:-----------|:---------|
| public static | `__callStatic( $method, array $parameters)`<br> |


<a id="rudra_container_facades_session"></a>

### Class: Rudra\Container\Facades\Session
| Visibility | Function |
|:-----------|:---------|
| public static | `__callStatic(string $method, array $parameters): ?mixed`<br>Handles static method calls for the Facade class.<br>It dynamically resolves the underlying class name by removing "Facade" from the class name.<br>If the resolved class does not exist, it attempts to clean up the class name by removing spaces.<br>If the resolved class is not already registered in the container, it registers it.<br>Finally, it delegates the static method call to the resolved class instance.<br>-------------------------<br>Обрабатывает статические вызовы методов для класса Facade.<br>Динамически разрешает имя базового класса, удаляя "Facade" из имени класса.<br>Если разрешённый класс не существует, пытается очистить имя класса, удаляя пробелы.<br>Если разрешённый класс ещё не зарегистрирован в контейнере, он регистрируется.<br>В конце делегирует статический вызов метода экземпляру разрешённого класса. |


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
| abstract public static | `run(): Rudra\Container\Interfaces\RudraInterface`<br>Implements the Singleton pattern to ensure only one instance of the class is created.<br>If the instance does not exist, it creates and stores it. Otherwise, it returns the existing instance.<br>-------------------------<br>Реализует паттерн Singleton, чтобы гарантировать создание только одного экземпляра класса.<br>Если экземпляр не существует, он создаётся и сохраняется. В противном случае возвращается существующий экземпляр. |


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
| private | `containerize(string $name, string $instance, array $data): Psr\Container\ContainerInterface`<br>Creates and stores a container instance if it does not already exist.<br>If the container for the given name does not exist in the `containers` array,<br>it creates a new instance of the specified class with the provided data and stores it.<br>Otherwise, it returns the existing container instance.<br>-------------------------<br>Создаёт и сохраняет экземпляр контейнера, если он ещё не существует.<br>Если контейнер с указанным именем отсутствует в массиве `containers`,<br>создаётся новый экземпляр указанного класса с предоставленными данными и сохраняется.<br>В противном случае возвращается существующий экземпляр контейнера. |
| private | `init(string $name, ?string $instance, array $data): ?mixed`<br>Initializes and retrieves an instance of a class or service.<br>If the instance is not already registered in the container, it registers it with the provided data.<br>The method uses the class name as the default instance if no specific instance is provided.<br>-------------------------<br>Инициализирует и извлекает экземпляр класса или сервиса.<br>Если экземпляр ещё не зарегистрирован в контейнере, он регистрируется с предоставленными данными.<br>Метод использует имя класса в качестве экземпляра по умолчанию, если конкретный экземпляр не указан. |


<a id="rudra_container_response"></a>

### Class: Rudra\Container\Response
| Visibility | Function |
|:-----------|:---------|
| public | `json(array $data): void`<br> |
| private | `getJson(array $data): string`<br> |


<a id="rudra_container_rudra"></a>

### Class: Rudra\Container\Rudra
| Visibility | Function |
|:-----------|:---------|
| public | `__call(string $method, array $parameters)`<br>Handles dynamic method calls for the class.<br>If the method exists in `allowedContainersMap`, it initializes a container<br>with the provided data and returns it.<br>If the method exists in `allowedInstances`, it initializes and returns<br>the corresponding instance.<br>If the method is not allowed (not found in either map), it throws a LogicException.<br>-------------------------<br>Обрабатывает динамические вызовы методов для класса.<br>Если метод существует в `allowedContainersMap`, инициализирует контейнер<br>с предоставленными данными и возвращает его.<br>Если метод существует в `allowedInstances`, инициализирует и возвращает<br>соответствующий экземпляр.<br>Если метод не разрешён (не найден ни в одной из карт), выбрасывается исключение LogicException. |
| public | `new(string $object, ?array $params): object`<br>Creates and returns a new instance of the specified class.<br>If the class has a constructor with parameters, it resolves and injects them using the provided parameters.<br>If the class does not exist, it throws a LogicException.<br>-------------------------<br>Создаёт и возвращает новый экземпляр указанного класса.<br>Если у класса есть конструктор с параметрами, разрешает их и внедряет, используя предоставленные параметры.<br>Если класс не существует, выбрасывается исключение LogicException. |
| public static | `run(): Rudra\Container\Interfaces\RudraInterface`<br>Implements the Singleton pattern to ensure only one instance of the class is created.<br>If the instance does not exist, it creates and stores it. Otherwise, it returns the existing instance.<br>-------------------------<br>Реализует паттерн Singleton, чтобы гарантировать создание только одного экземпляра класса.<br>Если экземпляр не существует, он создаётся и сохраняется. В противном случае возвращается существующий экземпляр. |
| public | `get(string $id): ?mixed`<br>Retrieves a service by its ID from the service container or waiting storage.<br>If the service exists in the container, it is returned directly.<br>If the service does not exist, it checks if the service can be resolved from the waiting storage or class name.<br>If the service cannot be resolved, it throws a NotFoundException.<br>-------------------------<br>Извлекает сервис по его идентификатору из контейнера сервисов или хранилища ожидания.<br>Если сервис существует в контейнере, он возвращается напрямую.<br>Если сервис не существует, проверяется, может ли он быть разрешён из хранилища ожидания или имени класса.<br>Если сервис не может быть разрешён, выбрасывается исключение NotFoundException. |
| public | `set(array $data): void`<br>Sets a value or object in the container, identified by a key.<br>If the key is not a string, it throws a LogicException.<br>If the object is an array, it processes the array using `handleArrayObject`.<br>Otherwise, it resolves and sets the object using `resolveSetValue` and `setObject`.<br>-------------------------<br>Устанавливает значение или объект в контейнере, идентифицированный ключом.<br>Если ключ не является строкой, выбрасывается исключение LogicException.<br>Если объект является массивом, он обрабатывается с помощью `handleArrayObject`.<br>В противном случае объект разрешается и устанавливается с помощью `resolveSetValue` и `setObject`. |
| private | `handleArrayObject(string $key, array $object): void`<br>Handles the processing of an array object during the setting process.<br>If the array contains more than one element and the first element is not an object,<br>it processes the array using dependency injection via the `iOc` method.<br>Otherwise, it resolves and sets the first element as the value for the given key.<br>-------------------------<br>Обрабатывает массив объектов во время процесса установки.<br>Если массив содержит более одного элемента, и первый элемент не является объектом,<br>он обрабатывает массив с использованием внедрения зависимостей через метод `iOc`.<br>В противном случае разрешает и устанавливает первый элемент как значение для указанного ключа. |
| private | `resolveSetValue(?mixed $value): ?mixed`<br>Resolves the value to be set in the container based on its type.<br>If the value is a Closure, it executes and returns the result.<br>If the value implements the Factory interface, it creates and returns an instance using the factory's `create` method.<br>Otherwise, it returns the value as-is.<br>-------------------------<br>Разрешает значение, которое должно быть установлено в контейнере, на основе его типа.<br>Если значение является замыканием (Closure), оно выполняется, и возвращается результат.<br>Если значение реализует интерфейс Factory, создаётся и возвращается экземпляр с использованием метода `create` фабрики.<br>В противном случае возвращается значение без изменений. |
| private | `isFactoryImplementation(?mixed $value): bool`<br>Checks if the given value represents a valid implementation of the FactoryInterface.<br>The value is considered valid if it is a string, the class exists, and it is a subclass of FactoryInterface.<br>-------------------------<br>Проверяет, представляет ли данное значение допустимую реализацию интерфейса FactoryInterface.<br>Значение считается допустимым, если оно является строкой, класс существует и является подклассом FactoryInterface. |
| public | `has(string $id): bool`<br> |
| private | `setObject(string $key, object\|string $object): void`<br>Sets an object or class in the service container.<br>If the provided value is an object, it is directly stored in the service container.<br>If the provided value is a string (class name), it resolves and sets the object using the `iOc` method.<br>-------------------------<br>Устанавливает объект или класс в контейнере сервисов.<br>Если предоставленное значение является объектом, он сохраняется напрямую в контейнере сервисов.<br>Если предоставленное значение является строкой (имя класса), разрешается и устанавливается объект с использованием метода `iOc`. |
| private | `iOc(string $key, string $object, ?array $params): void`<br>Resolves and sets an object in the service container using dependency injection.<br>It uses reflection to analyze the constructor of the specified class.<br>If the constructor has parameters, it resolves them using `getParamsIoC` and creates the instance with the resolved arguments.<br>If the constructor has no parameters, it creates the instance directly.<br>The created instance is then stored in the service container with the specified key.<br>-------------------------<br>Разрешает и устанавливает объект в контейнере сервисов с использованием внедрения зависимостей.<br>Использует рефлексию для анализа конструктора указанного класса.<br>Если конструктор имеет параметры, они разрешаются с помощью `getParamsIoC`, и экземпляр создаётся с использованием разрешённых аргументов.<br>Если конструктор не имеет параметров, экземпляр создаётся напрямую.<br>Созданный экземпляр затем сохраняется в контейнере сервисов с указанным ключом. |
| public | `autowire( $object, string $method, ?array $params): ?mixed`<br>Automatically resolves and invokes a method on the given object using dependency injection.<br>It uses reflection to analyze the method's parameters and resolves them using `getParamsIoC`.<br>If the method has no parameters, it is invoked directly. Otherwise, the resolved arguments are passed during invocation.<br>-------------------------<br>Автоматически разрешает и вызывает метод у указанного объекта с использованием внедрения зависимостей.<br>Использует рефлексию для анализа параметров метода и разрешает их с помощью `getParamsIoC`.<br>Если метод не имеет параметров, он вызывается напрямую. В противном случае разрешённые аргументы передаются при вызове. |
| public | `getParamsIoC(ReflectionMethod $constructor, ?array $params): array`<br>Resolves and retrieves parameters for dependency injection based on the constructor's reflection.<br>It processes each parameter of the constructor, resolving dependencies using bindings, class names, or default values.<br>If a parameter cannot be resolved, it uses the provided `$params` array.<br>-------------------------<br>Разрешает и извлекает параметры для внедрения зависимостей на основе рефлексии конструктора.<br>Обрабатывает каждый параметр конструктора, разрешая зависимости с использованием привязок, имён классов или значений по умолчанию.<br>Если параметр не может быть разрешён, используется предоставленный массив `$params`. |
| private | `resolveDependency( $className): object`<br>Resolves a dependency based on the provided class name or object.<br>If the dependency is a Closure, it executes and returns the result.<br>If the dependency is a string representing an existing class, it resolves the class using `resolveClass`.<br>If the dependency is an object, it resolves the object using `resolveObject`.<br>If the dependency exists in the waiting storage, it retrieves and resolves the service recursively.<br>Otherwise, it creates and returns a new instance of the class.<br>-------------------------<br>Разрешает зависимость на основе предоставленного имени класса или объекта.<br>Если зависимость является замыканием (Closure), оно выполняется, и возвращается результат.<br>Если зависимость является строкой, представляющей существующий класс, разрешает класс с помощью `resolveClass`.<br>Если зависимость является объектом, разрешает объект с помощью `resolveObject`.<br>Если зависимость существует в хранилище ожидания, извлекает и разрешает сервис рекурсивно.<br>В противном случае создаётся и возвращается новый экземпляр класса. |
| private | `resolveClass(string $className): object`<br>Resolves a class by creating an instance of it.<br>If the class implements or is a subclass of `FactoryInterface`, it creates an instance and calls the `create` method.<br>Otherwise, it simply creates and returns a new instance of the class.<br>-------------------------<br>Разрешает класс, создавая его экземпляр.<br>Если класс реализует или является подклассом `FactoryInterface`, создаётся экземпляр, и вызывается метод `create`.<br>В противном случае просто создаётся и возвращается новый экземпляр класса. |
| private | `resolveObject(object $object): object`<br>Resolves an object by checking if it implements the FactoryInterface.<br>If the object implements FactoryInterface, it calls the `create` method and returns the result.<br>Otherwise, it returns the object as-is.<br>-------------------------<br>Разрешает объект, проверяя, реализует ли он интерфейс FactoryInterface.<br>Если объект реализует FactoryInterface, вызывается метод `create`, и возвращается результат.<br>В противном случае объект возвращается без изменений. |
| private | `containerize(string $name, string $instance, array $data): Psr\Container\ContainerInterface`<br>Creates and stores a container instance if it does not already exist.<br>If the container for the given name does not exist in the `containers` array,<br>it creates a new instance of the specified class with the provided data and stores it.<br>Otherwise, it returns the existing container instance.<br>-------------------------<br>Создаёт и сохраняет экземпляр контейнера, если он ещё не существует.<br>Если контейнер с указанным именем отсутствует в массиве `containers`,<br>создаётся новый экземпляр указанного класса с предоставленными данными и сохраняется.<br>В противном случае возвращается существующий экземпляр контейнера. |
| private | `init(string $name, ?string $instance, array $data): ?mixed`<br>Initializes and retrieves an instance of a class or service.<br>If the instance is not already registered in the container, it registers it with the provided data.<br>The method uses the class name as the default instance if no specific instance is provided.<br>-------------------------<br>Инициализирует и извлекает экземпляр класса или сервиса.<br>Если экземпляр ещё не зарегистрирован в контейнере, он регистрируется с предоставленными данными.<br>Метод использует имя класса в качестве экземпляра по умолчанию, если конкретный экземпляр не указан. |


<a id="rudra_container_session"></a>

### Class: Rudra\Container\Session
| Visibility | Function |
|:-----------|:---------|
| public | `get(string $id): ?mixed`<br> |
| public | `set(array $data): void`<br> |
| private | `processSessionData(array $data): void`<br>Processes session data by merging or setting values.<br>If the key already exists and is an array, merges the new data.<br>Otherwise, sets the new value directly.<br>-------------------------<br>Обрабатывает данные сессии, объединяя или устанавливая значения.<br>Если ключ уже существует и является массивом, объединяет новые данные.<br>В противном случае устанавливает новое значение напрямую. |
| public | `has(string $id): bool`<br> |
| public | `unset(string $key): void`<br> |
| public | `setFlash(string $type, array $data): void`<br>Sets flash messages in the session.<br>Iterates through the provided data and sets each key-value pair as session data.<br>-------------------------<br>Устанавливает флеш-сообщения в сессии.<br>Перебирает предоставленные данные и устанавливает каждую пару ключ-значение как данные сессии. |
| public | `start(): void`<br> |
| public | `stop(): void`<br> |
| public | `clear(): void`<br> |


<a id="rudra_container_traits_facadetrait"></a>

### Class: Rudra\Container\Traits\FacadeTrait
| Visibility | Function |
|:-----------|:---------|
| public static | `__callStatic(string $method, array $parameters): ?mixed`<br>Handles static method calls for the Facade class.<br>It dynamically resolves the underlying class name by removing "Facade" from the class name.<br>If the resolved class does not exist, it attempts to clean up the class name by removing spaces.<br>If the resolved class is not already registered in the container, it registers it.<br>Finally, it delegates the static method call to the resolved class instance.<br>-------------------------<br>Обрабатывает статические вызовы методов для класса Facade.<br>Динамически разрешает имя базового класса, удаляя "Facade" из имени класса.<br>Если разрешённый класс не существует, пытается очистить имя класса, удаляя пробелы.<br>Если разрешённый класс ещё не зарегистрирован в контейнере, он регистрируется.<br>В конце делегирует статический вызов метода экземпляру разрешённого класса. |


<a id="rudra_container_traits_instantiationstrait"></a>

### Class: Rudra\Container\Traits\InstantiationsTrait
| Visibility | Function |
|:-----------|:---------|
| private | `containerize(string $name, string $instance, array $data): Psr\Container\ContainerInterface`<br>Creates and stores a container instance if it does not already exist.<br>If the container for the given name does not exist in the `containers` array,<br>it creates a new instance of the specified class with the provided data and stores it.<br>Otherwise, it returns the existing container instance.<br>-------------------------<br>Создаёт и сохраняет экземпляр контейнера, если он ещё не существует.<br>Если контейнер с указанным именем отсутствует в массиве `containers`,<br>создаётся новый экземпляр указанного класса с предоставленными данными и сохраняется.<br>В противном случае возвращается существующий экземпляр контейнера. |
| private | `init(string $name, ?string $instance, array $data): ?mixed`<br>Initializes and retrieves an instance of a class or service.<br>If the instance is not already registered in the container, it registers it with the provided data.<br>The method uses the class name as the default instance if no specific instance is provided.<br>-------------------------<br>Инициализирует и извлекает экземпляр класса или сервиса.<br>Если экземпляр ещё не зарегистрирован в контейнере, он регистрируется с предоставленными данными.<br>Метод использует имя класса в качестве экземпляра по умолчанию, если конкретный экземпляр не указан. |


<a id="rudra_container_traits_setrudracontainerstrait"></a>

### Class: Rudra\Container\Traits\SetRudraContainersTrait
| Visibility | Function |
|:-----------|:---------|
| public | `__construct(Rudra\Container\Interfaces\RudraInterface $rudra)`<br> |
| public | `rudra(): Rudra\Container\Interfaces\RudraInterface`<br> |
<hr>

###### created with [Rudra-Documentation-Collector](#https://github.com/Jagepard/Rudra-Documentation-Collector)
