<?php

declare(strict_types = 1);

/**
 * Date: 25.08.2016
 * Time: 14:50
 *
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2016, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra;


use \ReflectionClass;


/**
 * Class IContainer
 *
 * @package Rudra
 */
class Container implements IContainer
{

    /**
     * @var array
     */
    protected $get;

    /**
     * @var array
     */
    protected $post;

    /**
     * @var array
     */
    protected $server;

    /**
     * @var array
     */
    protected $files;

    /**
     * @var IContainer
     */
    public static $app;

    /**
     * @var array
     */
    protected $objects = [];

    /**
     * @var array
     */
    protected $bind = [];


    /**
     * Container constructor.
     */
    protected function __construct()
    {
        $this->get    = $_GET;
        $this->post   = $_POST;
        $this->server = $_SERVER;
        $this->files  = $_FILES;
    }

    /**
     * @return IContainer
     */
    public static function app(): IContainer
    {
        if (!static::$app instanceof static) {
            static::$app = new static();
        }

        return static::$app;
    }

    /**
     * @param $app
     */
    public function setServices(array $app): void
    {
        foreach ($app['services'] as $name => $service) {
            foreach ($app['contracts'] as $interface => $contract) {
                $this->setBinding($interface, $contract);
            }

            if (array_key_exists(1, $service)) {
                $this->set($name, $service[0], $service[1]);
            } else {
                $this->set($name, $service[0]);
            }
        }
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function get(string $key = null)
    {
        return ($key === null) ? $this->objects : $this->objects[$key];
    }

    /**
     * @param string $key
     * @param        $object
     * @param array  $params
     *
     * @return object|void
     */
    public function set(string $key, $object, $params = null)
    {
        if ('raw' == $params) {
            return $this->rawSet($key, $object);
        }

        return $this->IoC($key, $object, $params);
    }

    /**
     * @param string $key
     * @param        $object
     */
    protected function rawSet(string $key, $object)
    {
        $this->objects[$key] = $object;
    }

    /**
     * @param      $key
     * @param      $object
     * @param null $params
     *
     * @return object
     */
    protected function IoC(string $key, $object, $params = null)
    {
        $reflection  = new ReflectionClass($object);
        $constructor = $reflection->getConstructor();

        if ($constructor) {
            if ($constructor->getNumberOfParameters()) {
                $paramsIoC = $this->getParamsIoC($constructor, $params);

                return $this->objects[$key] = $reflection->newInstanceArgs($paramsIoC);
            } else {
                return $this->objects[$key] = new $object;
            }
        } else {
            return $this->objects[$key] = new $object;
        }
    }

    /**
     * @param      $object
     * @param null $params
     *
     * @return object
     */
    public function new($object, $params = null)
    {
        $reflection  = new ReflectionClass($object);
        $constructor = $reflection->getConstructor();

        if ($constructor) {
            if ($constructor->getNumberOfParameters()) {
                $paramsIoC = $this->getParamsIoC($constructor, $params);

                return $reflection->newInstanceArgs($paramsIoC);
            } else {
                return new $object;
            }
        } else {
            return new $object;
        }
    }

    /**
     * @param $constructor
     * @param $params
     *
     * @return array
     */
    protected function getParamsIoC($constructor, $params)
    {
        $paramsIoC = [];
        foreach ($constructor->getParameters() as $key => $value) {
            if (isset($value->getClass()->name)) {
                $className       = $this->getBinding($value->getClass()->name);
                $paramsIoC[$key] = (is_object($className)) ? $className : new $className;
            } else {
                $paramsIoC[$key] = ($value->isDefaultValueAvailable())
                    ? $value->getDefaultValue() : $params[$value->getName()];
            }
        }

        return $paramsIoC;
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($this->objects[$key]) ? true : false;
    }

    /**
     * @param string $key
     * @param string $param
     *
     * @return mixed
     */
    public function getParam(string $key, string $param)
    {
        if ($this->has($key)) {
            if (isset($this->get($key)->$param)) {
                return $this->get($key)->$param;
            }
        }
    }

    /**
     * @param string $key
     * @param string $param
     * @param        $value
     */
    public function setParam(string $key, string $param, $value): void
    {
        if (isset($this->objects[$key])) {
            $this->get($key)->$param = $value;
        }
    }

    /**
     * @param string $key
     * @param string $param
     *
     * @return bool
     */
    public function hasParam(string $key, string $param)
    {
        if ($this->has($key)) {
            return isset($this->get($key)->$param) ? true : false;
        }
    }

    /**
     * @param string|null $key
     *
     * @return array|mixed
     */
    public function getGet(string $key = null)
    {
        return empty($key) ? $this->get : $this->get[$key];
    }

    /**
     * @param array $get
     */
    public function setGet(array $get): void
    {
        $this->get = $get;
    }


    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasGet(string $key): bool
    {
        return isset($this->get[$key]);
    }

    /**
     * @param string|null $key
     *
     * @return array|mixed
     */
    public function getPost(string $key = null)
    {
        return empty($key) ? $this->post : $this->post[$key];
    }

    /**
     * @param array $post
     */
    public function setPost(array $post): void
    {
        $this->post = $post;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasPost(string $key): bool
    {
        return isset($this->post[$key]);
    }

    /**
     * @param string $key
     *
     * @return string
     */
    public function getServer(string $key): string
    {
        return $this->server[$key];
    }

    /**
     * @param array $server
     */
    public function setServer(array $server)
    {
        $this->server = $server;
    }

    /**
     * @param string      $key
     * @param string|null $subKey
     *
     * @return mixed
     */
    public function getSession(string $key, string $subKey = null)
    {
        return ($subKey === null) ? $_SESSION[$key] : $_SESSION[$key][$subKey];
    }

    /**
     * @param string      $key
     * @param             $value
     * @param string|null $subKey
     */
    public function setSession(string $key, $value, string $subKey = null): void
    {
        if (empty($subKey)) {
            $_SESSION[$key] = $value;
        } else {
            if ($subKey == 'increment') {
                $_SESSION[$key][] = $value;
            } else {
                $_SESSION[$key][$subKey] = $value;
            }
        }
    }

    /**
     * @param string $key
     * @param string $subKey
     *
     * @return bool
     */
    public function hasSession(string $key, string $subKey = null): bool
    {
        return empty($subKey) ? isset($_SESSION[$key]) : isset($_SESSION[$key][$subKey]);
    }

    /**
     * @param string      $key
     * @param string|null $subKey
     */
    public function unsetSession(string $key, string $subKey = null): void
    {
        if (empty($subKey)) {
            unset($_SESSION[$key]);
        } else {
            unset($_SESSION[$key][$subKey]);
        }
    }

    /**
     * @codeCoverageIgnore
     */
    public function startSession(): void
    {
        session_start();
    }

    /**
     * @codeCoverageIgnore
     */
    public function stopSession(): void
    {
        session_destroy();
    }

    public function clearSession(): void
    {
        $_SESSION = [];
    }

    /**
     * @param array $files
     */
    public function setFiles(array $files)
    {
        $this->files = $files;
    }

    /**
     * @param string $key
     * @param string $fieldName
     * @param string $formName
     *
     * @return string
     */
    public function getUpload(string $key, string $fieldName, string $formName = 'upload') : string
    {
        return $this->files[$formName][$fieldName][$key];
    }

    /**
     * @param string $value
     * @param string $formName
     *
     * @return bool
     */
    public function isUploaded(string $value, string $formName = 'upload') : bool
    {
        return ($this->files[$formName]['name'][$value] !== '');
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return bool
     */
    public function isFileType(string $key, string $value) : bool
    {
        return ($this->files['type'][$key] == $value) ? true : false;
    }

    /**
     * @param string $key
     *
     * @return string
     */
    public function getCookie(string $key): string
    {
        return $_COOKIE[$key];
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasCookie(string $key): bool
    {
        return isset($_COOKIE[$key]);
    }

    /**
     * @codeCoverageIgnore
     *
     * @param string $key
     */
    public function unsetCookie(string $key): void
    {
        unset($_COOKIE[$key]);
        setcookie($key, null, -1, '/');
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setCookie(string $key, string $value): void
    {
        $_COOKIE[$key] = $value;
    }

    /**
     * @param string $key
     *
     * @return mixed|string
     */
    public function getBinding(string $key)
    {
        return $this->bind[$key] ?? $key;
    }

    /**
     * @param string $key
     * @param        $value
     */
    public function setBinding(string $key, $value): void
    {
        $this->bind[$key] = $value;
    }
}
