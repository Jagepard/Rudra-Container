## Table of contents
- [Rudra\Container\Container](#rudra_container_container)
- [Rudra\Container\Cookie](#rudra_container_cookie)
- [Rudra\Container\Facades\Cookie](#rudra_container_facades_cookie)
- [Rudra\Container\Facades\Request](#rudra_container_facades_request)
- [Rudra\Container\Facades\Response](#rudra_container_facades_response)
- [Rudra\Container\Facades\Rudra](#rudra_container_facades_rudra)
- [Rudra\Container\Facades\Session](#rudra_container_facades_session)
- [Rudra\Container\Files](#rudra_container_files)
- [Rudra\Container\Interfaces\ContainerInterface](#rudra_container_interfaces_containerinterface)
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
##### implements [Rudra\Container\Interfaces\ContainerInterface](#rudra_container_interfaces_containerinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>__construct</strong>( array $data )</em><br>Sets data<br>Устанавливает данные|
|public|<em><strong>get</strong>( ?string $key ): mixed</em><br>Gets an element by key or the entire array of data<br>Получает элемент по ключу или весь массив данных|
|public|<em><strong>set</strong>( array $data ): void</em><br>Sets data<br>Устанавливает данные|
|public|<em><strong>has</strong>( string $key ): bool</em><br>Checks for the existence of data by key<br>Проверяет наличие данных по ключу|


<a id="rudra_container_cookie"></a>

### Class: Rudra\Container\Cookie
##### implements [Rudra\Container\Interfaces\ContainerInterface](#rudra_container_interfaces_containerinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>get</strong>( ?string $key ): mixed</em><br>Gets an element by key or the entire array of data<br>Получает элемент по ключу или весь массив данных|
|public|<em><strong>has</strong>( string $key ): bool</em><br>Checks for the existence of data by key<br>Проверяет наличие данных по ключу|
|public|<em><strong>unset</strong>( string $key ): void</em><br>Unset a given variable<br>Удаляет переменную|
|public|<em><strong>set</strong>( array $data ): void</em><br>Sets data<br>Устанавливает данные|


<a id="rudra_container_facades_cookie"></a>

### Class: Rudra\Container\Facades\Cookie
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>( string $method  array $parameters ): mixed</em><br>Calls class methods statically<br>Вызывает методы класса статически|


<a id="rudra_container_facades_request"></a>

### Class: Rudra\Container\Facades\Request
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>( string $method  array $parameters ): mixed</em><br>Calls class methods statically<br>Вызывает методы класса статически|


<a id="rudra_container_facades_response"></a>

### Class: Rudra\Container\Facades\Response
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>( string $method  array $parameters ): mixed</em><br>Calls class methods statically<br>Вызывает методы класса статически|


<a id="rudra_container_facades_rudra"></a>

### Class: Rudra\Container\Facades\Rudra
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>(  $method  array $parameters )</em><br>|


<a id="rudra_container_facades_session"></a>

### Class: Rudra\Container\Facades\Session
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>( string $method  array $parameters ): mixed</em><br>Calls class methods statically<br>Вызывает методы класса статически|


<a id="rudra_container_files"></a>

### Class: Rudra\Container\Files
##### extends [Rudra\Container\Container](#rudra_container_container)
##### implements [Rudra\Container\Interfaces\ContainerInterface](#rudra_container_interfaces_containerinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>getLoaded</strong>( string $key  string $fieldName  string $formName ): string</em><br>|
|public|<em><strong>isLoaded</strong>( string $value  string $formName ): bool</em><br>|
|public|<em><strong>isFileType</strong>( string $key  string $value ): bool</em><br>|
|public|<em><strong>__construct</strong>( array $data )</em><br>Sets data<br>Устанавливает данные|
|public|<em><strong>get</strong>( ?string $key ): mixed</em><br>Gets an element by key or the entire array of data<br>Получает элемент по ключу или весь массив данных|
|public|<em><strong>set</strong>( array $data ): void</em><br>Sets data<br>Устанавливает данные|
|public|<em><strong>has</strong>( string $key ): bool</em><br>Checks for the existence of data by key<br>Проверяет наличие данных по ключу|


<a id="rudra_container_interfaces_containerinterface"></a>

### Class: Rudra\Container\Interfaces\ContainerInterface
| Visibility | Function |
|:-----------|:---------|
|abstract public|<em><strong>get</strong>( ?string $key ): mixed</em><br>Gets the container element<br>Получает элемент контейнера|
|abstract public|<em><strong>set</strong>( array $data ): void</em><br>Adds data to the container<br>Добавляет данные в контейнер|
|abstract public|<em><strong>has</strong>( string $key ): bool</em><br>Checks if the element is in the container<br>Проверяет наличие элемента в контейнере|


<a id="rudra_container_interfaces_requestinterface"></a>

### Class: Rudra\Container\Interfaces\RequestInterface
| Visibility | Function |
|:-----------|:---------|
|abstract public|<em><strong>get</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>Creates a container for HTTP GET variables<br>Создает контейнер для переменных HTTP GET|
|abstract public|<em><strong>post</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>Creates a container for HTTP POST variables<br>Создает контейнер для переменных HTTP POST|
|abstract public|<em><strong>put</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>Creates a container for HTTP PUT variables<br>Создает контейнер для переменных HTTP PUT|
|abstract public|<em><strong>patch</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>Creates a container for HTTP PATCH variables<br>Создает контейнер для переменных HTTP PATCH|
|abstract public|<em><strong>delete</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>Creates a container for HTTP DELETE variables<br>Создает контейнер для переменных HTTP DELETE|
|abstract public|<em><strong>server</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>Creates a container for server and execution environment information<br>Создает контейнер для информации о сервере и среде исполнения|
|abstract public|<em><strong>files</strong>(): Rudra\Container\Files</em><br>Creates a container for HTTP File Upload variables<br>Создает контейнер для переменных файлов, загруженных по HTTP|


<a id="rudra_container_interfaces_responseinterface"></a>

### Class: Rudra\Container\Interfaces\ResponseInterface
| Visibility | Function |
|:-----------|:---------|
|abstract public|<em><strong>json</strong>( array $data ): void</em><br>Displays data in JSON format<br>Отображает данные в формате JSON.|


<a id="rudra_container_interfaces_rudrainterface"></a>

### Class: Rudra\Container\Interfaces\RudraInterface
| Visibility | Function |
|:-----------|:---------|
|abstract public static|<em><strong>run</strong>(): Rudra\Container\Interfaces\RudraInterface</em><br>Creates the main application singleton<br>Создает основной синглтон приложения|


<a id="rudra_container_request"></a>

### Class: Rudra\Container\Request
##### implements [Rudra\Container\Interfaces\RequestInterface](#rudra_container_interfaces_requestinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>get</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>Creates a container for HTTP GET variables<br>Создает контейнер для переменных HTTP GET|
|public|<em><strong>post</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>Creates a container for HTTP POST variables<br>Создает контейнер для переменных HTTP POST|
|public|<em><strong>put</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>Creates a container for HTTP PUT variables<br>Создает контейнер для переменных HTTP PUT|
|public|<em><strong>patch</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>Creates a container for HTTP PATCH variables<br>Создает контейнер для переменных HTTP PATCH|
|public|<em><strong>delete</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>Creates a container for HTTP DELETE variables<br>Создает контейнер для переменных HTTP DELETE|
|public|<em><strong>server</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>Creates a container for server and execution environment information<br>Создает контейнер для информации о сервере и среде исполнения|
|public|<em><strong>files</strong>(): Rudra\Container\Files</em><br>Creates a container for HTTP File Upload variables<br>Создает контейнер для переменных файлов, загруженных по HTTP|
|private|<em><strong>containerize</strong>( string $name  string $instance  array $data ): Rudra\Container\Interfaces\ContainerInterface</em><br>Creates a container instance<br>Создает экземпляр контейнера|
|private|<em><strong>init</strong>( string $name  ?string $instance  array $data ): mixed</em><br>Initializes the service<br>Иницианализирует сервис|


<a id="rudra_container_response"></a>

### Class: Rudra\Container\Response
##### implements [Rudra\Container\Interfaces\ResponseInterface](#rudra_container_interfaces_responseinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>json</strong>( array $data ): void</em><br>Displays data in JSON format<br>Отображает данные в формате JSON.|
|private|<em><strong>getJson</strong>( array $data ): string</em><br>Returns the JSON representation of a value<br>Возвращает JSONпредставление данных|


<a id="rudra_container_rudra"></a>

### Class: Rudra\Container\Rudra
##### implements [Rudra\Container\Interfaces\RudraInterface](#rudra_container_interfaces_rudrainterface)
##### implements [Rudra\Container\Interfaces\ContainerInterface](#rudra_container_interfaces_containerinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>__call</strong>( string $method  array $parameters )</em><br>Initializes a service or creates a container<br>Инициализирует сервис или создает контейнер|
|public|<em><strong>bind</strong>( string $contract   $realisation ): void</em><br>Associates an interface with an implementation<br>Связвает интерфейс с реализацией|
|public|<em><strong>new</strong>( string $object  ?array $params ): object</em><br>Creates an object without adding to the container<br>Создает объект без добавления в контейнер|
|public static|<em><strong>run</strong>(): Rudra\Container\Interfaces\RudraInterface</em><br>Creates the main application singleton<br>Создает основной синглтон приложения|
|public|<em><strong>get</strong>( ?string $key ): mixed</em><br>Gets a service by key, or an array of services if no key is specified<br>Получает сервис по ключу или массив сервисов, если ключ не указан|
|public|<em><strong>set</strong>( array $data ): void</em><br>Adds a service to an application<br>Добавляет сервис в приложение|
|public|<em><strong>has</strong>( string $key ): bool</em><br>Checks for the existence of a service<br>Проверяет наличие сервиса|
|private|<em><strong>setObject</strong>( string $key  object|string $object ): void</em><br>Sets an object<br>Устанавливает объект|
|private|<em><strong>iOc</strong>( string $key  string $object  ?array $params ): void</em><br>Creates an object using inversion of control<br>Создает объект при помощи инверсии контроля|
|public|<em><strong>autowire</strong>(  $object  string $method  ?array $params )</em><br>Calls a method using inversion of control<br>Вызывает метод при помощи инверсии контроля|
|private|<em><strong>getParamsIoC</strong>( ReflectionMethod $constructor  ?array $params ): array</em><br>Gets parameters using inversion of control<br>Получает параметры при помощи инверсии контроля|
|private|<em><strong>containerize</strong>( string $name  string $instance  array $data ): Rudra\Container\Interfaces\ContainerInterface</em><br>Creates a container instance<br>Создает экземпляр контейнера|
|private|<em><strong>init</strong>( string $name  ?string $instance  array $data ): mixed</em><br>Initializes the service<br>Иницианализирует сервис|


<a id="rudra_container_session"></a>

### Class: Rudra\Container\Session
##### implements [Rudra\Container\Interfaces\ContainerInterface](#rudra_container_interfaces_containerinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>get</strong>( ?string $key ): mixed</em><br>Gets an element by key or the entire array of data<br>Получает элемент по ключу или весь массив данных|
|public|<em><strong>set</strong>( array $data ): void</em><br>Sets session data<br>Устанавливает данные сессии|
|public|<em><strong>has</strong>( string $key ): bool</em><br>Checks for the existence of data by key<br>Проверяет наличие данных по ключу|
|public|<em><strong>unset</strong>( string $key ): void</em><br>Unset a given variable from array<br>Удаляет переменную из массива|
|public|<em><strong>setFlash</strong>( string $type  array $data ): void</em><br>|
|public|<em><strong>start</strong>(): void</em><br>Start new or resume existing session<br>Стартует новую сессию, либо возобновляет существующую|
|public|<em><strong>stop</strong>(): void</em><br>Destroys all data registered to a session<br>Уничтожает все данные сессии |
|public|<em><strong>clear</strong>(): void</em><br>Clears the $_SESSION array<br>Очищает массив $_SESSION|


<a id="rudra_container_traits_facadetrait"></a>

### Class: Rudra\Container\Traits\FacadeTrait
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>( string $method  array $parameters ): mixed</em><br>Calls class methods statically<br>Вызывает методы класса статически|


<a id="rudra_container_traits_instantiationstrait"></a>

### Class: Rudra\Container\Traits\InstantiationsTrait
| Visibility | Function |
|:-----------|:---------|
|private|<em><strong>containerize</strong>( string $name  string $instance  array $data ): Rudra\Container\Interfaces\ContainerInterface</em><br>Creates a container instance<br>Создает экземпляр контейнера|
|private|<em><strong>init</strong>( string $name  ?string $instance  array $data ): mixed</em><br>Initializes the service<br>Иницианализирует сервис|


<a id="rudra_container_traits_setrudracontainerstrait"></a>

### Class: Rudra\Container\Traits\SetRudraContainersTrait
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>__construct</strong>( Rudra\Container\Interfaces\RudraInterface $rudra )</em><br>Takes RudraInterface as an argument<br>Принимает в качестве аргумента RudraInterface|
|public|<em><strong>rudra</strong>(): Rudra\Container\Interfaces\RudraInterface</em><br>Gets access to the application<br>Получает доступ к приложению|
<hr>

###### created with [Rudra-Documentation-Collector](#https://github.com/Jagepard/Rudra-Documentation-Collector)
