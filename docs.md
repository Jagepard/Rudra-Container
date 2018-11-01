## Table of contents

- [\Rudra\Container](#class-rudracontainer)
- [\Rudra\Interfaces\ContainerInterface (interface)](#interface-rudrainterfacescontainerinterface)

<hr /><a id="class-rudracontainer"></a>
### Class: \Rudra\Container

> Class Container

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>app()</strong> : <em>[\Rudra\Interfaces\ContainerInterface](#interface-rudrainterfacescontainerinterface)</em> |
| public | <strong>clearSession()</strong> : <em>void</em> |
| public | <strong>config(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$subKey=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>get(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array/mixed</em> |
| public | <strong>getBinding(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>mixed/string</em> |
| public | <strong>getConfig()</strong> : <em>array</em> |
| public | <strong>getCookie(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>string</em> |
| public | <strong>getDelete(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array</em> |
| public | <strong>getGet(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array</em> |
| public | <strong>getParam(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$param</strong>)</strong> : <em>mixed</em> |
| public | <strong>getPatch(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array</em> |
| public | <strong>getPost(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array</em> |
| public | <strong>getPut(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array</em> |
| public | <strong>getServer(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array/null</em> |
| public | <strong>getSession(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$subKey=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>getUpload(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$fieldName</strong>, <em>\string</em> <strong>$formName=`'upload'`</strong>)</strong> : <em>string</em> |
| public | <strong>has(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>hasBinding(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>hasCookie(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>hasDelete(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>hasGet(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>hasParam(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$param</strong>)</strong> : <em>bool</em> |
| public | <strong>hasPatch(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>hasPost(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>hasPut(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>hasSession(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$subKey=null</strong>)</strong> : <em>bool</em> |
| public | <strong>isFileType(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$value</strong>)</strong> : <em>bool</em> |
| public | <strong>isUploaded(</strong><em>\string</em> <strong>$value</strong>, <em>\string</em> <strong>$formName=`'upload'`</strong>)</strong> : <em>bool</em> |
| public | <strong>jsonResponse(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>new(</strong><em>mixed</em> <strong>$object</strong>, <em>null</em> <strong>$params=null</strong>)</strong> : <em>mixed/object</em> |
| public | <strong>set(</strong><em>\string</em> <strong>$key</strong>, <em>mixed</em> <strong>$object</strong>, <em>null</em> <strong>$params=null</strong>)</strong> : <em>object/void</em> |
| public | <strong>setBinding(</strong><em>\string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>setConfig(</strong><em>array</em> <strong>$config</strong>)</strong> : <em>void</em> |
| public | <strong>setCookie(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>setDelete(</strong><em>array</em> <strong>$delete</strong>)</strong> : <em>void</em> |
| public | <strong>setFiles(</strong><em>array</em> <strong>$files</strong>)</strong> : <em>void</em> |
| public | <strong>setGet(</strong><em>array</em> <strong>$get</strong>)</strong> : <em>void</em> |
| public | <strong>setParam(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$param</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>setPatch(</strong><em>array</em> <strong>$patch</strong>)</strong> : <em>void</em> |
| public | <strong>setPost(</strong><em>array</em> <strong>$post</strong>)</strong> : <em>void</em> |
| public | <strong>setPut(</strong><em>array</em> <strong>$put</strong>)</strong> : <em>void</em> |
| public | <strong>setServer(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>setServices(</strong><em>array</em> <strong>$app</strong>)</strong> : <em>void</em> |
| public | <strong>setSession(</strong><em>\string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>\string</em> <strong>$subKey=null</strong>)</strong> : <em>void</em> |
| public | <strong>startSession()</strong> : <em>void</em> |
| public | <strong>stopSession()</strong> : <em>void</em> |
| public | <strong>unsetCookie(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>unsetSession(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$subKey=null</strong>)</strong> : <em>void</em> |
| protected | <strong>__construct()</strong> : <em>void</em><br /><em>Container constructor.</em> |
| protected | <strong>getJson(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>string</em> |
| protected | <strong>getParamsIoC(</strong><em>[\ReflectionMethod](http://php.net/manual/en/class.reflectionmethod.php)</em> <strong>$constructor</strong>, <em>mixed</em> <strong>$params</strong>)</strong> : <em>array</em> |
| protected | <strong>iOc(</strong><em>\string</em> <strong>$key</strong>, <em>mixed</em> <strong>$object</strong>, <em>null</em> <strong>$params=null</strong>)</strong> : <em>void</em> |
| protected | <strong>rawSet(</strong><em>\string</em> <strong>$key</strong>, <em>mixed</em> <strong>$object</strong>)</strong> : <em>void</em> |

*This class implements [\Rudra\Interfaces\ContainerInterface](#interface-rudrainterfacescontainerinterface)*

<hr /><a id="interface-rudrainterfacescontainerinterface"></a>
### Interface: \Rudra\Interfaces\ContainerInterface

> Interface ContainerInterface

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>app()</strong> : <em>[\Rudra\Interfaces\ContainerInterface](#interface-rudrainterfacescontainerinterface)</em> |
| public | <strong>clearSession()</strong> : <em>void</em> |
| public | <strong>config(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$subKey=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>get(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array/mixed</em> |
| public | <strong>getBinding(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>mixed/string</em> |
| public | <strong>getConfig()</strong> : <em>array</em> |
| public | <strong>getCookie(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>string</em> |
| public | <strong>getDelete(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array</em> |
| public | <strong>getGet(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array</em> |
| public | <strong>getParam(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$param</strong>)</strong> : <em>mixed</em> |
| public | <strong>getPatch(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array</em> |
| public | <strong>getPost(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array</em> |
| public | <strong>getPut(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array</em> |
| public | <strong>getServer(</strong><em>\string</em> <strong>$key=null</strong>)</strong> : <em>array/null</em> |
| public | <strong>getSession(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$subKey=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>getUpload(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$fieldName</strong>, <em>\string</em> <strong>$formName=`'upload'`</strong>)</strong> : <em>string</em> |
| public | <strong>has(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>hasCookie(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>hasDelete(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>hasGet(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>hasParam(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$param</strong>)</strong> : <em>bool</em> |
| public | <strong>hasPatch(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>hasPost(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>hasPut(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>bool</em> |
| public | <strong>hasSession(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$subKey=null</strong>)</strong> : <em>bool</em> |
| public | <strong>isFileType(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$value</strong>)</strong> : <em>bool</em> |
| public | <strong>isUploaded(</strong><em>\string</em> <strong>$value</strong>, <em>\string</em> <strong>$formName=`'upload'`</strong>)</strong> : <em>bool</em> |
| public | <strong>jsonResponse(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>new(</strong><em>mixed</em> <strong>$object</strong>, <em>null</em> <strong>$params=null</strong>)</strong> : <em>mixed/object</em> |
| public | <strong>set(</strong><em>\string</em> <strong>$key</strong>, <em>mixed</em> <strong>$object</strong>, <em>null</em> <strong>$params=null</strong>)</strong> : <em>object/void</em> |
| public | <strong>setBinding(</strong><em>\string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>setConfig(</strong><em>array</em> <strong>$config</strong>)</strong> : <em>void</em> |
| public | <strong>setCookie(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>setDelete(</strong><em>array</em> <strong>$delete</strong>)</strong> : <em>void</em> |
| public | <strong>setFiles(</strong><em>array</em> <strong>$files</strong>)</strong> : <em>void</em> |
| public | <strong>setGet(</strong><em>array</em> <strong>$get</strong>)</strong> : <em>void</em> |
| public | <strong>setParam(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$param</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>setPatch(</strong><em>array</em> <strong>$patch</strong>)</strong> : <em>void</em> |
| public | <strong>setPost(</strong><em>array</em> <strong>$post</strong>)</strong> : <em>void</em> |
| public | <strong>setPut(</strong><em>array</em> <strong>$put</strong>)</strong> : <em>void</em> |
| public | <strong>setServer(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>setServices(</strong><em>mixed/array</em> <strong>$app</strong>)</strong> : <em>void</em> |
| public | <strong>setSession(</strong><em>\string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>, <em>\string</em> <strong>$subKey=null</strong>)</strong> : <em>void</em> |
| public | <strong>startSession()</strong> : <em>void</em> |
| public | <strong>stopSession()</strong> : <em>void</em> |
| public | <strong>unsetCookie(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>unsetSession(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$subKey=null</strong>)</strong> : <em>void</em> |

