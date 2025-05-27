## Table of contents
- [Rudra\Container\Container](#rudra_container_container)
- [Rudra\Container\Cookie](#rudra_container_cookie)
- [Rudra\Container\Exceptions\NotFoundException](#rudra_container_exceptions_notfoundexception)
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
##### implements [Psr\Container\ContainerInterface](#psr_container_containerinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>__construct</strong>( array $data )</em><br>|
|public|<em><strong>get</strong>( string $id ): mixed</em><br>|
|public|<em><strong>all</strong>(): array</em><br>|
|public|<em><strong>set</strong>( array $data ): void</em><br>|
|public|<em><strong>has</strong>( string $id ): bool</em><br>|


<a id="rudra_container_cookie"></a>

### Class: Rudra\Container\Cookie
##### implements [Psr\Container\ContainerInterface](#psr_container_containerinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>get</strong>( string $id ): mixed</em><br>|
|public|<em><strong>has</strong>( string $id ): bool</em><br>|
|public|<em><strong>unset</strong>( string $id ): void</em><br>|
|private|<em><strong>deleteCookie</strong>( string $id ): void</em><br>|
|public|<em><strong>set</strong>( array $data ): void</em><br>|
|private|<em><strong>processCookieData</strong>( array $data ): void</em><br>|


<a id="rudra_container_exceptions_notfoundexception"></a>

### Class: Rudra\Container\Exceptions\NotFoundException
##### extends [RuntimeException](#runtimeexception)
##### implements [Throwable](#throwable)
##### implements [Stringable](#stringable)
##### implements [Psr\Container\NotFoundExceptionInterface](#psr_container_notfoundexceptioninterface)
##### implements [Psr\Container\ContainerExceptionInterface](#psr_container_containerexceptioninterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>__construct</strong>( string $message  int $code  ?Throwable $previous )</em><br>|
|public|<em><strong>__wakeup</strong>()</em><br>|
|final public|<em><strong>getMessage</strong>(): string</em><br>|
|final public|<em><strong>getCode</strong>()</em><br>|
|final public|<em><strong>getFile</strong>(): string</em><br>|
|final public|<em><strong>getLine</strong>(): int</em><br>|
|final public|<em><strong>getTrace</strong>(): array</em><br>|
|final public|<em><strong>getPrevious</strong>(): ?Throwable</em><br>|
|final public|<em><strong>getTraceAsString</strong>(): string</em><br>|
|public|<em><strong>__toString</strong>(): string</em><br>|


<a id="rudra_container_facades_cookie"></a>

### Class: Rudra\Container\Facades\Cookie
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>( string $method  array $parameters ): mixed</em><br>|


<a id="rudra_container_facades_request"></a>

### Class: Rudra\Container\Facades\Request
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>( string $method  array $parameters ): mixed</em><br>|


<a id="rudra_container_facades_response"></a>

### Class: Rudra\Container\Facades\Response
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>( string $method  array $parameters ): mixed</em><br>|


<a id="rudra_container_facades_rudra"></a>

### Class: Rudra\Container\Facades\Rudra
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>(  $method  array $parameters )</em><br>|


<a id="rudra_container_facades_session"></a>

### Class: Rudra\Container\Facades\Session
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>( string $method  array $parameters ): mixed</em><br>|


<a id="rudra_container_interfaces_factoryinterface"></a>

### Class: Rudra\Container\Interfaces\FactoryInterface
| Visibility | Function |
|:-----------|:---------|
|abstract public|<em><strong>create</strong>(): object</em><br>|


<a id="rudra_container_interfaces_requestinterface"></a>

### Class: Rudra\Container\Interfaces\RequestInterface
| Visibility | Function |
|:-----------|:---------|
|abstract public|<em><strong>get</strong>(): Psr\Container\ContainerInterface</em><br>|
|abstract public|<em><strong>post</strong>(): Psr\Container\ContainerInterface</em><br>|
|abstract public|<em><strong>put</strong>(): Psr\Container\ContainerInterface</em><br>|
|abstract public|<em><strong>patch</strong>(): Psr\Container\ContainerInterface</em><br>|
|abstract public|<em><strong>delete</strong>(): Psr\Container\ContainerInterface</em><br>|
|abstract public|<em><strong>server</strong>(): Psr\Container\ContainerInterface</em><br>|
|abstract public|<em><strong>files</strong>(): Psr\Container\ContainerInterface</em><br>|


<a id="rudra_container_interfaces_responseinterface"></a>

### Class: Rudra\Container\Interfaces\ResponseInterface
| Visibility | Function |
|:-----------|:---------|
|abstract public|<em><strong>json</strong>( array $data ): void</em><br>|


<a id="rudra_container_interfaces_rudrainterface"></a>

### Class: Rudra\Container\Interfaces\RudraInterface
| Visibility | Function |
|:-----------|:---------|
|abstract public static|<em><strong>run</strong>(): Rudra\Container\Interfaces\RudraInterface</em><br>|


<a id="rudra_container_request"></a>

### Class: Rudra\Container\Request
##### implements [Rudra\Container\Interfaces\RequestInterface](#rudra_container_interfaces_requestinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>get</strong>(): Psr\Container\ContainerInterface</em><br>|
|public|<em><strong>post</strong>(): Psr\Container\ContainerInterface</em><br>|
|public|<em><strong>put</strong>(): Psr\Container\ContainerInterface</em><br>|
|public|<em><strong>patch</strong>(): Psr\Container\ContainerInterface</em><br>|
|public|<em><strong>delete</strong>(): Psr\Container\ContainerInterface</em><br>|
|public|<em><strong>server</strong>(): Psr\Container\ContainerInterface</em><br>|
|public|<em><strong>files</strong>(): Psr\Container\ContainerInterface</em><br>|
|private|<em><strong>containerize</strong>( string $name  string $instance  array $data ): Psr\Container\ContainerInterface</em><br>|
|private|<em><strong>init</strong>( string $name  ?string $instance  array $data ): mixed</em><br>|


<a id="rudra_container_response"></a>

### Class: Rudra\Container\Response
##### implements [Rudra\Container\Interfaces\ResponseInterface](#rudra_container_interfaces_responseinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>json</strong>( array $data ): void</em><br>|
|private|<em><strong>getJson</strong>( array $data ): string</em><br>|


<a id="rudra_container_rudra"></a>

### Class: Rudra\Container\Rudra
##### implements [Rudra\Container\Interfaces\RudraInterface](#rudra_container_interfaces_rudrainterface)
##### implements [Psr\Container\ContainerInterface](#psr_container_containerinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>__call</strong>( string $method  array $parameters )</em><br>|
|public|<em><strong>new</strong>( string $object  ?array $params ): object</em><br>|
|public static|<em><strong>run</strong>(): Rudra\Container\Interfaces\RudraInterface</em><br>|
|public|<em><strong>get</strong>( string $id ): mixed</em><br>|
|public|<em><strong>set</strong>( array $data ): void</em><br>|
|private|<em><strong>handleArrayObject</strong>( string $key  array $object ): void</em><br>|
|private|<em><strong>resolveSetValue</strong>(  $value ): mixed</em><br>|
|private|<em><strong>isFactoryImplementation</strong>(  $value ): bool</em><br>|
|public|<em><strong>has</strong>( string $id ): bool</em><br>|
|private|<em><strong>setObject</strong>( string $key  object|string $object ): void</em><br>|
|private|<em><strong>iOc</strong>( string $key  string $object  ?array $params ): void</em><br>|
|public|<em><strong>autowire</strong>(  $object  string $method  ?array $params ): mixed</em><br>|
|public|<em><strong>getParamsIoC</strong>( ReflectionMethod $constructor  ?array $params ): array</em><br>|
|private|<em><strong>resolveDependency</strong>(  $className ): object</em><br>|
|private|<em><strong>resolveClass</strong>( string $className ): object</em><br>|
|private|<em><strong>resolveObject</strong>( object $object ): object</em><br>|
|private|<em><strong>containerize</strong>( string $name  string $instance  array $data ): Psr\Container\ContainerInterface</em><br>|
|private|<em><strong>init</strong>( string $name  ?string $instance  array $data ): mixed</em><br>|


<a id="rudra_container_session"></a>

### Class: Rudra\Container\Session
##### implements [Psr\Container\ContainerInterface](#psr_container_containerinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>get</strong>( string $id ): mixed</em><br>|
|public|<em><strong>set</strong>( array $data ): void</em><br>|
|private|<em><strong>processSessionData</strong>( array $data ): void</em><br>|
|public|<em><strong>has</strong>( string $id ): bool</em><br>|
|public|<em><strong>unset</strong>( string $key ): void</em><br>|
|public|<em><strong>setFlash</strong>( string $type  array $data ): void</em><br>|
|public|<em><strong>start</strong>(): void</em><br>|
|public|<em><strong>stop</strong>(): void</em><br>|
|public|<em><strong>clear</strong>(): void</em><br>|


<a id="rudra_container_traits_facadetrait"></a>

### Class: Rudra\Container\Traits\FacadeTrait
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>( string $method  array $parameters ): mixed</em><br>|


<a id="rudra_container_traits_instantiationstrait"></a>

### Class: Rudra\Container\Traits\InstantiationsTrait
| Visibility | Function |
|:-----------|:---------|
|private|<em><strong>containerize</strong>( string $name  string $instance  array $data ): Psr\Container\ContainerInterface</em><br>|
|private|<em><strong>init</strong>( string $name  ?string $instance  array $data ): mixed</em><br>|


<a id="rudra_container_traits_setrudracontainerstrait"></a>

### Class: Rudra\Container\Traits\SetRudraContainersTrait
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>__construct</strong>( Rudra\Container\Interfaces\RudraInterface $rudra )</em><br>|
|public|<em><strong>rudra</strong>(): Rudra\Container\Interfaces\RudraInterface</em><br>|
<hr>

###### created with [Rudra-Documentation-Collector](#https://github.com/Jagepard/Rudra-Documentation-Collector)
