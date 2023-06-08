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
|public|<em><strong>__construct</strong>( array $data )</em><br>|
|public|<em><strong>get</strong>( ?string $key )</em><br>|
|public|<em><strong>set</strong>( array $data ): void</em><br>|
|public|<em><strong>has</strong>( string $key ): bool</em><br>|


<a id="rudra_container_cookie"></a>

### Class: Rudra\Container\Cookie
##### implements [Rudra\Container\Interfaces\ContainerInterface](#rudra_container_interfaces_containerinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>get</strong>( ?string $key )</em><br>|
|public|<em><strong>has</strong>( string $key ): bool</em><br>|
|public|<em><strong>unset</strong>( string $key ): void</em><br>|
|public|<em><strong>set</strong>( array $data ): void</em><br>|


<a id="rudra_container_facades_cookie"></a>

### Class: Rudra\Container\Facades\Cookie
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>(  $method   $parameters )</em><br>|


<a id="rudra_container_facades_request"></a>

### Class: Rudra\Container\Facades\Request
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>(  $method   $parameters )</em><br>|


<a id="rudra_container_facades_response"></a>

### Class: Rudra\Container\Facades\Response
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>(  $method   $parameters )</em><br>|


<a id="rudra_container_facades_rudra"></a>

### Class: Rudra\Container\Facades\Rudra
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>(  $method   $parameters )</em><br>|


<a id="rudra_container_facades_session"></a>

### Class: Rudra\Container\Facades\Session
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>(  $method   $parameters )</em><br>|


<a id="rudra_container_files"></a>

### Class: Rudra\Container\Files
##### extends [Rudra\Container\Container](#rudra_container_container)
##### implements [Rudra\Container\Interfaces\ContainerInterface](#rudra_container_interfaces_containerinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>getLoaded</strong>( string $key  string $fieldName  string $formName ): string</em><br>|
|public|<em><strong>isLoaded</strong>( string $value  string $formName ): bool</em><br>|
|public|<em><strong>isFileType</strong>( string $key  string $value ): bool</em><br>|
|public|<em><strong>__construct</strong>( array $data )</em><br>|
|public|<em><strong>get</strong>( ?string $key )</em><br>|
|public|<em><strong>set</strong>( array $data ): void</em><br>|
|public|<em><strong>has</strong>( string $key ): bool</em><br>|


<a id="rudra_container_interfaces_containerinterface"></a>

### Class: Rudra\Container\Interfaces\ContainerInterface
| Visibility | Function |
|:-----------|:---------|
|abstract public|<em><strong>get</strong>( ?string $key )</em><br>|
|abstract public|<em><strong>set</strong>( array $data ): void</em><br>|
|abstract public|<em><strong>has</strong>( string $key ): bool</em><br>|


<a id="rudra_container_interfaces_requestinterface"></a>

### Class: Rudra\Container\Interfaces\RequestInterface
| Visibility | Function |
|:-----------|:---------|
|abstract public|<em><strong>get</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>|
|abstract public|<em><strong>post</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>|
|abstract public|<em><strong>put</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>|
|abstract public|<em><strong>patch</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>|
|abstract public|<em><strong>delete</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>|
|abstract public|<em><strong>server</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>|
|abstract public|<em><strong>files</strong>(): Rudra\Container\Files</em><br>|


<a id="rudra_container_interfaces_responseinterface"></a>

### Class: Rudra\Container\Interfaces\ResponseInterface
| Visibility | Function |
|:-----------|:---------|
|abstract public|<em><strong>json</strong>( array $data ): void</em><br>|


<a id="rudra_container_interfaces_rudrainterface"></a>

### Class: Rudra\Container\Interfaces\RudraInterface
| Visibility | Function |
|:-----------|:---------|
|abstract public|<em><strong>config</strong>( array $config ): Rudra\Container\Interfaces\ContainerInterface</em><br>|
|abstract public|<em><strong>services</strong>( array $services ): Rudra\Container\Interfaces\ContainerInterface</em><br>|
|abstract public|<em><strong>binding</strong>( array $contracts ): Rudra\Container\Interfaces\ContainerInterface</em><br>|
|abstract public|<em><strong>request</strong>(): Rudra\Container\Interfaces\RequestInterface</em><br>|
|abstract public|<em><strong>response</strong>(): Rudra\Container\Interfaces\ResponseInterface</em><br>|
|abstract public static|<em><strong>run</strong>(): Rudra\Container\Interfaces\RudraInterface</em><br>|
|abstract public|<em><strong>cookie</strong>(): Rudra\Container\Cookie</em><br>|
|abstract public|<em><strong>session</strong>(): Rudra\Container\Session</em><br>|


<a id="rudra_container_request"></a>

### Class: Rudra\Container\Request
##### implements [Rudra\Container\Interfaces\RequestInterface](#rudra_container_interfaces_requestinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>get</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>|
|public|<em><strong>post</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>|
|public|<em><strong>put</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>|
|public|<em><strong>patch</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>|
|public|<em><strong>delete</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>|
|public|<em><strong>server</strong>(): Rudra\Container\Interfaces\ContainerInterface</em><br>|
|public|<em><strong>files</strong>(): Rudra\Container\Files</em><br>|
|private|<em><strong>containerize</strong>( string $name  string $instance   $data )</em><br>|
|private|<em><strong>serviceCreation</strong>( string $name  ?string $instance   $data )</em><br>|


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
##### implements [Rudra\Container\Interfaces\ContainerInterface](#rudra_container_interfaces_containerinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>binding</strong>( array $contracts ): Rudra\Container\Interfaces\ContainerInterface</em><br>|
|public|<em><strong>services</strong>( array $services ): Rudra\Container\Interfaces\ContainerInterface</em><br>|
|public|<em><strong>config</strong>( array $config ): Rudra\Container\Interfaces\ContainerInterface</em><br>|
|public|<em><strong>data</strong>( array $data ): Rudra\Container\Interfaces\ContainerInterface</em><br>|
|public|<em><strong>request</strong>(): Rudra\Container\Interfaces\RequestInterface</em><br>|
|public|<em><strong>response</strong>(): Rudra\Container\Interfaces\ResponseInterface</em><br>|
|public|<em><strong>cookie</strong>(): Rudra\Container\Cookie</em><br>|
|public|<em><strong>session</strong>(): Rudra\Container\Session</em><br>|
|public|<em><strong>new</strong>(  $object   $params )</em><br>|
|public static|<em><strong>run</strong>(): Rudra\Container\Interfaces\RudraInterface</em><br>|
|public|<em><strong>get</strong>( ?string $key )</em><br>|
|public|<em><strong>set</strong>( array $data ): void</em><br>|
|public|<em><strong>has</strong>( string $key ): bool</em><br>|
|private|<em><strong>setObject</strong>(  $object   $key ): void</em><br>|
|private|<em><strong>mergeData</strong>( string $key   $object )</em><br>|
|private|<em><strong>iOc</strong>( string $key   $object   $params ): void</em><br>|
|private|<em><strong>getParamsIoC</strong>( ReflectionMethod $constructor   $params ): array</em><br>|
|private|<em><strong>containerize</strong>( string $name  string $instance   $data )</em><br>|
|private|<em><strong>serviceCreation</strong>( string $name  ?string $instance   $data )</em><br>|


<a id="rudra_container_session"></a>

### Class: Rudra\Container\Session
##### implements [Rudra\Container\Interfaces\ContainerInterface](#rudra_container_interfaces_containerinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>get</strong>( ?string $key )</em><br>|
|public|<em><strong>set</strong>( array $data ): void</em><br>|
|public|<em><strong>has</strong>( string $key ): bool</em><br>|
|public|<em><strong>unset</strong>( string $key ): void</em><br>|
|public|<em><strong>setFlash</strong>( string $type  array $data ): void</em><br>|
|public|<em><strong>start</strong>(): void</em><br>|
|public|<em><strong>stop</strong>(): void</em><br>|
|public|<em><strong>clear</strong>(): void</em><br>|


<a id="rudra_container_traits_facadetrait"></a>

### Class: Rudra\Container\Traits\FacadeTrait
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>(  $method   $parameters )</em><br>|


<a id="rudra_container_traits_instantiationstrait"></a>

### Class: Rudra\Container\Traits\InstantiationsTrait
| Visibility | Function |
|:-----------|:---------|
|private|<em><strong>containerize</strong>( string $name  string $instance   $data )</em><br>|
|private|<em><strong>serviceCreation</strong>( string $name  ?string $instance   $data )</em><br>|


<a id="rudra_container_traits_setrudracontainerstrait"></a>

### Class: Rudra\Container\Traits\SetRudraContainersTrait
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>__construct</strong>( Rudra\Container\Interfaces\RudraInterface $rudra )</em><br>|
|public|<em><strong>rudra</strong>(): Rudra\Container\Interfaces\RudraInterface</em><br>|
<hr>

###### created with [Rudra-Documentation-Collector](#https://github.com/Jagepard/Rudra-Documentation-Collector)
