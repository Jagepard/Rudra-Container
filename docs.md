## Table of contents

- [\Rudra\Container\Files](#class-rudracontainerfiles)
- [\Rudra\Container\Objects](#class-rudracontainerobjects)
- [\Rudra\Container\Cookie](#class-rudracontainercookie)
- [\Rudra\Container\Response](#class-rudracontainerresponse)
- [\Rudra\Container\Session](#class-rudracontainersession)
- [\Rudra\Container\Container](#class-rudracontainercontainer)
- [\Rudra\Container\Request](#class-rudracontainerrequest)
- [\Rudra\Container\Application](#class-rudracontainerapplication)
- [\Rudra\Container\Interfaces\ResponseInterface (interface)](#interface-rudracontainerinterfacesresponseinterface)
- [\Rudra\Container\Interfaces\ApplicationInterface (interface)](#interface-rudracontainerinterfacesapplicationinterface)
- [\Rudra\Container\Interfaces\ContainerInterface (interface)](#interface-rudracontainerinterfacescontainerinterface)
- [\Rudra\Container\Interfaces\RequestInterface (interface)](#interface-rudracontainerinterfacesrequestinterface)

<hr /><a id="class-rudracontainerfiles"></a>
### Class: \Rudra\Container\Files

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getLoaded(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$fieldName</strong>, <em>\string</em> <strong>$formName=`'upload'`</strong>)</strong> : <em>string</em> |
| public | <strong>isFileType(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$value</strong>)</strong> : <em>bool</em> |
| public | <strong>isLoaded(</strong><em>\string</em> <strong>$value</strong>, <em>\string</em> <strong>$formName=`'upload'`</strong>)</strong> : <em>bool</em> |

*This class extends [\Rudra\Container\Container](#class-rudracontainercontainer)*

*This class implements [\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)*

<hr /><a id="class-rudracontainerobjects"></a>
### Class: \Rudra\Container\Objects

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed/[\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)</em> <strong>$binding</strong>)</strong> : <em>void</em><br /><em>Objects constructor.</em> |
| public | <strong>new(</strong><em>mixed</em> <strong>$object</strong>, <em>null</em> <strong>$params=null</strong>)</strong> : <em>object</em> |
| public | <strong>set(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |

*This class extends [\Rudra\Container\Container](#class-rudracontainercontainer)*

*This class implements [\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)*

<hr /><a id="class-rudracontainercookie"></a>
### Class: \Rudra\Container\Cookie

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array/mixed</em> |
| public | <strong>has(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>set(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>unset(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>void</em> |

*This class implements [\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)*

<hr /><a id="class-rudracontainerresponse"></a>
### Class: \Rudra\Container\Response

| Visibility | Function |
|:-----------|:---------|
| public | <strong>json(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |

*This class implements [\Rudra\Container\Interfaces\ResponseInterface](#interface-rudracontainerinterfacesresponseinterface)*

<hr /><a id="class-rudracontainersession"></a>
### Class: \Rudra\Container\Session

| Visibility | Function |
|:-----------|:---------|
| public | <strong>clear()</strong> : <em>void</em> |
| public | <strong>get(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>has(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>set(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>start()</strong> : <em>void</em> |
| public | <strong>stop()</strong> : <em>void</em> |
| public | <strong>unset(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>void</em> |

*This class implements [\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)*

<hr /><a id="class-rudracontainercontainer"></a>
### Class: \Rudra\Container\Container

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array</em> |
| public | <strong>has(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>set(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |

*This class implements [\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)*

<hr /><a id="class-rudracontainerrequest"></a>
### Class: \Rudra\Container\Request

| Visibility | Function |
|:-----------|:---------|
| public | <strong>delete()</strong> : <em>[\Rudra\Container\Container](#class-rudracontainercontainer)Interface</em> |
| public | <strong>files()</strong> : <em>[\Rudra\Container\Files](#class-rudracontainerfiles)</em> |
| public | <strong>get()</strong> : <em>[\Rudra\Container\Container](#class-rudracontainercontainer)Interface</em> |
| public | <strong>patch()</strong> : <em>[\Rudra\Container\Container](#class-rudracontainercontainer)Interface</em> |
| public | <strong>post()</strong> : <em>[\Rudra\Container\Container](#class-rudracontainercontainer)Interface</em> |
| public | <strong>put()</strong> : <em>[\Rudra\Container\Container](#class-rudracontainercontainer)Interface</em> |
| public | <strong>server()</strong> : <em>[\Rudra\Container\Container](#class-rudracontainercontainer)Interface</em> |

*This class implements [\Rudra\Container\Interfaces\RequestInterface](#interface-rudracontainerinterfacesrequestinterface)*

<hr /><a id="class-rudracontainerapplication"></a>
### Class: \Rudra\Container\Application

| Visibility | Function |
|:-----------|:---------|
| public | <strong>binding()</strong> : <em>[\Rudra\Container\Container](#class-rudracontainercontainer)Interface</em> |
| public | <strong>config()</strong> : <em>[\Rudra\Container\Container](#class-rudracontainercontainer)Interface</em> |
| public | <strong>cookie()</strong> : <em>[\Rudra\Container\Container](#class-rudracontainercontainer)Interface</em> |
| public | <strong>objects()</strong> : <em>[\Rudra\Container\Container](#class-rudracontainercontainer)Interface</em> |
| public | <strong>request()</strong> : <em>[\Rudra\Container\Request](#class-rudracontainerrequest)Interface</em> |
| public | <strong>response()</strong> : <em>[\Rudra\Container\Response](#class-rudracontainerresponse)Interface</em> |
| public static | <strong>run()</strong> : <em>[\Rudra\Container\Application](#class-rudracontainerapplication)Interface</em> |
| public | <strong>session()</strong> : <em>[\Rudra\Container\Container](#class-rudracontainercontainer)Interface</em> |
| public | <strong>setServices(</strong><em>array</em> <strong>$services</strong>)</strong> : <em>void</em> |

*This class implements [\Rudra\Container\Interfaces\ApplicationInterface](#interface-rudracontainerinterfacesapplicationinterface)*

<hr /><a id="interface-rudracontainerinterfacesresponseinterface"></a>
### Interface: \Rudra\Container\Interfaces\ResponseInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>json(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |

<hr /><a id="interface-rudracontainerinterfacesapplicationinterface"></a>
### Interface: \Rudra\Container\Interfaces\ApplicationInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>binding()</strong> : <em>[\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)</em> |
| public | <strong>config()</strong> : <em>[\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)</em> |
| public | <strong>cookie()</strong> : <em>[\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)</em> |
| public | <strong>objects()</strong> : <em>[\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)</em> |
| public | <strong>request()</strong> : <em>[\Rudra\Container\Interfaces\RequestInterface](#interface-rudracontainerinterfacesrequestinterface)</em> |
| public | <strong>response()</strong> : <em>[\Rudra\Container\Interfaces\ResponseInterface](#interface-rudracontainerinterfacesresponseinterface)</em> |
| public static | <strong>run()</strong> : <em>[\Rudra\Container\Interfaces\ApplicationInterface](#interface-rudracontainerinterfacesapplicationinterface)</em> |
| public | <strong>session()</strong> : <em>[\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)</em> |
| public | <strong>setServices(</strong><em>mixed/array</em> <strong>$services</strong>)</strong> : <em>void</em> |

<hr /><a id="interface-rudracontainerinterfacescontainerinterface"></a>
### Interface: \Rudra\Container\Interfaces\ContainerInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>has(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>set(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |

<hr /><a id="interface-rudracontainerinterfacesrequestinterface"></a>
### Interface: \Rudra\Container\Interfaces\RequestInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>delete()</strong> : <em>[\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)</em> |
| public | <strong>files()</strong> : <em>[\Rudra\Container\Files](#class-rudracontainerfiles)</em> |
| public | <strong>get()</strong> : <em>[\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)</em> |
| public | <strong>patch()</strong> : <em>[\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)</em> |
| public | <strong>post()</strong> : <em>[\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)</em> |
| public | <strong>put()</strong> : <em>[\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)</em> |
| public | <strong>server()</strong> : <em>[\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)</em> |

