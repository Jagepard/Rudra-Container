## Table of contents

- [\Rudra\Container\Config](#class-rudracontainerconfig)
- [\Rudra\Container\Cookie](#class-rudracontainercookie)
- [\Rudra\Container\Response](#class-rudracontainerresponse)
- [\Rudra\Container\AbstractContainer](#class-rudracontainerabstractcontainer)
- [\Rudra\Container\Session](#class-rudracontainersession)
- [\Rudra\Container\Request](#class-rudracontainerrequest)
- [\Rudra\Container\Application](#class-rudracontainerapplication)
- [\Rudra\Container\Interfaces\ReflectionInterface (interface)](#interface-rudracontainerinterfacesreflectioninterface)
- [\Rudra\Container\Interfaces\ResponseInterface (interface)](#interface-rudracontainerinterfacesresponseinterface)
- [\Rudra\Container\Interfaces\ApplicationInterface (interface)](#interface-rudracontainerinterfacesapplicationinterface)
- [\Rudra\Container\Interfaces\SessionInterface (interface)](#interface-rudracontainerinterfacessessioninterface)
- [\Rudra\Container\Interfaces\ContainerInterface (interface)](#interface-rudracontainerinterfacescontainerinterface)
- [\Rudra\Container\Interfaces\RequestInterface (interface)](#interface-rudracontainerinterfacesrequestinterface)
- [\Rudra\Container\Interfaces\CookieInterface (interface)](#interface-rudracontainerinterfacescookieinterface)
- [\Rudra\Container\Request\Get](#class-rudracontainerrequestget)
- [\Rudra\Container\Request\Delete](#class-rudracontainerrequestdelete)
- [\Rudra\Container\Request\Files](#class-rudracontainerrequestfiles)
- [\Rudra\Container\Request\Put](#class-rudracontainerrequestput)
- [\Rudra\Container\Request\Server](#class-rudracontainerrequestserver)
- [\Rudra\Container\Request\Patch](#class-rudracontainerrequestpatch)
- [\Rudra\Container\Request\Post](#class-rudracontainerrequestpost)

<hr /><a id="class-rudracontainerconfig"></a>
### Class: \Rudra\Container\Config

| Visibility | Function |
|:-----------|:---------|
| public | <strong>add(</strong><em>mixed</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |

*This class extends [\Rudra\Container\AbstractContainer](#class-rudracontainerabstractcontainer)*

*This class implements [\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)*

<hr /><a id="class-rudracontainercookie"></a>
### Class: \Rudra\Container\Cookie

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>string</em> |
| public | <strong>has(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>set(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>unset(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>void</em> |

*This class implements [\Rudra\Container\Interfaces\CookieInterface](#interface-rudracontainerinterfacescookieinterface)*

<hr /><a id="class-rudracontainerresponse"></a>
### Class: \Rudra\Container\Response

| Visibility | Function |
|:-----------|:---------|
| public | <strong>jsonResponse(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |

*This class implements [\Rudra\Container\Interfaces\ResponseInterface](#interface-rudracontainerinterfacesresponseinterface)*

<hr /><a id="class-rudracontainerabstractcontainer"></a>
### Class: \Rudra\Container\AbstractContainer

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$data=array()</strong>)</strong> : <em>void</em><br /><em>AbstractRequestMethod constructor.</em> |
| public | <strong>get(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array</em> |
| public | <strong>has(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>set(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |

*This class implements [\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)*

<hr /><a id="class-rudracontainersession"></a>
### Class: \Rudra\Container\Session

| Visibility | Function |
|:-----------|:---------|
| public | <strong>clear()</strong> : <em>void</em> |
| public | <strong>get(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$subKey=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>has(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$subKey=null</strong>)</strong> : <em>bool</em> |
| public | <strong>set(</strong><em>\string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>\string</em> <strong>$subKey=null</strong>)</strong> : <em>void</em> |
| public | <strong>start()</strong> : <em>void</em> |
| public | <strong>stop()</strong> : <em>void</em> |
| public | <strong>unset(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$subKey=null</strong>)</strong> : <em>void</em> |

*This class implements [\Rudra\Container\Interfaces\SessionInterface](#interface-rudracontainerinterfacessessioninterface)*

<hr /><a id="class-rudracontainerrequest"></a>
### Class: \Rudra\Container\Request

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em> |
| public | <strong>delete()</strong> : <em>\Rudra\Container\ContainerInterface</em> |
| public | <strong>files()</strong> : <em>\Rudra\Container\Files</em> |
| public | <strong>get()</strong> : <em>\Rudra\Container\ContainerInterface</em> |
| public | <strong>patch()</strong> : <em>\Rudra\Container\ContainerInterface</em> |
| public | <strong>post()</strong> : <em>\Rudra\Container\ContainerInterface</em> |
| public | <strong>put()</strong> : <em>\Rudra\Container\ContainerInterface</em> |
| public | <strong>server()</strong> : <em>\Rudra\Container\Server</em> |

*This class implements [\Rudra\Container\Interfaces\RequestInterface](#interface-rudracontainerinterfacesrequestinterface)*

<hr /><a id="class-rudracontainerapplication"></a>
### Class: \Rudra\Container\Application

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em> |
| public static | <strong>app()</strong> : <em>[\Rudra\Container\Application](#class-rudracontainerapplication)Interface</em> |
| public | <strong>config()</strong> : <em>\Rudra\Container\ContainerInterface</em> |
| public | <strong>cookie()</strong> : <em>[\Rudra\Container\Cookie](#class-rudracontainercookie)Interface</em> |
| public | <strong>get(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array/mixed</em> |
| public | <strong>getBinding(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>mixed/string</em> |
| public | <strong>getParam(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$param</strong>)</strong> : <em>mixed</em> |
| public | <strong>has(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>hasBinding(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>hasParam(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$param</strong>)</strong> : <em>bool</em> |
| public | <strong>new(</strong><em>mixed</em> <strong>$object</strong>, <em>null</em> <strong>$params=null</strong>)</strong> : <em>object</em> |
| public | <strong>request()</strong> : <em>[\Rudra\Container\Request](#class-rudracontainerrequest)</em> |
| public | <strong>response()</strong> : <em>[\Rudra\Container\Response](#class-rudracontainerresponse)Interface</em> |
| public | <strong>session()</strong> : <em>[\Rudra\Container\Session](#class-rudracontainersession)Interface</em> |
| public | <strong>set(</strong><em>\string</em> <strong>$key</strong>, <em>mixed</em> <strong>$object</strong>, <em>null</em> <strong>$params=null</strong>)</strong> : <em>void</em> |
| public | <strong>setBinding(</strong><em>\string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>setParam(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$param</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>setServices(</strong><em>array</em> <strong>$services</strong>)</strong> : <em>void</em> |

*This class implements [\Rudra\Container\Interfaces\ApplicationInterface](#interface-rudracontainerinterfacesapplicationinterface), [\Rudra\Container\Interfaces\ReflectionInterface](#interface-rudracontainerinterfacesreflectioninterface)*

<hr /><a id="interface-rudracontainerinterfacesreflectioninterface"></a>
### Interface: \Rudra\Container\Interfaces\ReflectionInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array/mixed</em> |
| public | <strong>getBinding(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>mixed/string</em> |
| public | <strong>getParam(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$param</strong>)</strong> : <em>mixed</em> |
| public | <strong>has(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>hasParam(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$param</strong>)</strong> : <em>bool</em> |
| public | <strong>new(</strong><em>mixed</em> <strong>$object</strong>, <em>null</em> <strong>$params=null</strong>)</strong> : <em>mixed/object</em> |
| public | <strong>set(</strong><em>\string</em> <strong>$key</strong>, <em>mixed</em> <strong>$object</strong>, <em>null</em> <strong>$params=null</strong>)</strong> : <em>object/void</em> |
| public | <strong>setBinding(</strong><em>\string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>setParam(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$param</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |

<hr /><a id="interface-rudracontainerinterfacesresponseinterface"></a>
### Interface: \Rudra\Container\Interfaces\ResponseInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>jsonResponse(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |

<hr /><a id="interface-rudracontainerinterfacesapplicationinterface"></a>
### Interface: \Rudra\Container\Interfaces\ApplicationInterface

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>app()</strong> : <em>[\Rudra\Container\Interfaces\ApplicationInterface](#interface-rudracontainerinterfacesapplicationinterface)</em> |
| public | <strong>config()</strong> : <em>[\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)</em> |
| public | <strong>cookie()</strong> : <em>[\Rudra\Container\Interfaces\CookieInterface](#interface-rudracontainerinterfacescookieinterface)</em> |
| public | <strong>request()</strong> : <em>[\Rudra\Container\Request](#class-rudracontainerrequest)</em> |
| public | <strong>response()</strong> : <em>[\Rudra\Container\Interfaces\ResponseInterface](#interface-rudracontainerinterfacesresponseinterface)</em> |
| public | <strong>session()</strong> : <em>[\Rudra\Container\Interfaces\SessionInterface](#interface-rudracontainerinterfacessessioninterface)</em> |
| public | <strong>setServices(</strong><em>mixed/array</em> <strong>$app</strong>)</strong> : <em>void</em> |

<hr /><a id="interface-rudracontainerinterfacessessioninterface"></a>
### Interface: \Rudra\Container\Interfaces\SessionInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>clear()</strong> : <em>void</em> |
| public | <strong>get(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$subKey=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>has(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$subKey=null</strong>)</strong> : <em>bool</em> |
| public | <strong>set(</strong><em>\string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>\string</em> <strong>$subKey=null</strong>)</strong> : <em>void</em> |
| public | <strong>start()</strong> : <em>void</em> |
| public | <strong>stop()</strong> : <em>void</em> |
| public | <strong>unset(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$subKey=null</strong>)</strong> : <em>void</em> |

<hr /><a id="interface-rudracontainerinterfacescontainerinterface"></a>
### Interface: \Rudra\Container\Interfaces\ContainerInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array</em> |
| public | <strong>has(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>set(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |

<hr /><a id="interface-rudracontainerinterfacesrequestinterface"></a>
### Interface: \Rudra\Container\Interfaces\RequestInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>delete()</strong> : <em>[\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)</em> |
| public | <strong>files()</strong> : <em>[\Rudra\Container\Request\Files](#class-rudracontainerrequestfiles)</em> |
| public | <strong>get()</strong> : <em>[\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)</em> |
| public | <strong>patch()</strong> : <em>[\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)</em> |
| public | <strong>post()</strong> : <em>[\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)</em> |
| public | <strong>put()</strong> : <em>[\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)</em> |
| public | <strong>server()</strong> : <em>[\Rudra\Container\Request\Server](#class-rudracontainerrequestserver)</em> |

<hr /><a id="interface-rudracontainerinterfacescookieinterface"></a>
### Interface: \Rudra\Container\Interfaces\CookieInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>string</em> |
| public | <strong>has(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>set(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>unset(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>void</em> |

<hr /><a id="class-rudracontainerrequestget"></a>
### Class: \Rudra\Container\Request\Get

| Visibility | Function |
|:-----------|:---------|

*This class extends [\Rudra\Container\AbstractContainer](#class-rudracontainerabstractcontainer)*

*This class implements [\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)*

<hr /><a id="class-rudracontainerrequestdelete"></a>
### Class: \Rudra\Container\Request\Delete

| Visibility | Function |
|:-----------|:---------|

*This class extends [\Rudra\Container\AbstractContainer](#class-rudracontainerabstractcontainer)*

*This class implements [\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)*

<hr /><a id="class-rudracontainerrequestfiles"></a>
### Class: \Rudra\Container\Request\Files

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getLoaded(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$fieldName</strong>, <em>\string</em> <strong>$formName=`'upload'`</strong>)</strong> : <em>string</em> |
| public | <strong>isFileType(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$value</strong>)</strong> : <em>bool</em> |
| public | <strong>isLoaded(</strong><em>\string</em> <strong>$value</strong>, <em>\string</em> <strong>$formName=`'upload'`</strong>)</strong> : <em>bool</em> |

*This class extends [\Rudra\Container\AbstractContainer](#class-rudracontainerabstractcontainer)*

*This class implements [\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)*

<hr /><a id="class-rudracontainerrequestput"></a>
### Class: \Rudra\Container\Request\Put

| Visibility | Function |
|:-----------|:---------|

*This class extends [\Rudra\Container\AbstractContainer](#class-rudracontainerabstractcontainer)*

*This class implements [\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)*

<hr /><a id="class-rudracontainerrequestserver"></a>
### Class: \Rudra\Container\Request\Server

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array/null</em> |
| public | <strong>setValue(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$value</strong>)</strong> : <em>void</em> |

*This class extends [\Rudra\Container\AbstractContainer](#class-rudracontainerabstractcontainer)*

*This class implements [\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)*

<hr /><a id="class-rudracontainerrequestpatch"></a>
### Class: \Rudra\Container\Request\Patch

| Visibility | Function |
|:-----------|:---------|

*This class extends [\Rudra\Container\AbstractContainer](#class-rudracontainerabstractcontainer)*

*This class implements [\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)*

<hr /><a id="class-rudracontainerrequestpost"></a>
### Class: \Rudra\Container\Request\Post

| Visibility | Function |
|:-----------|:---------|

*This class extends [\Rudra\Container\AbstractContainer](#class-rudracontainerabstractcontainer)*

*This class implements [\Rudra\Container\Interfaces\ContainerInterface](#interface-rudracontainerinterfacescontainerinterface)*

