<?php

/**
 * Date: 25.08.2016
 * Time: 14:50
 *
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2016, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra;

/**
 * Class IContainer
 *
 * @package Rudra
 */
class Container implements IContainer
{

    use InversionOfControl;

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
     * @var
     */
    public static $app;

    /**
     * @var array
     */
    protected $objects = [];

    /**
     * @var
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
     * @return static
     */
    public static function app()
    {
        if (!static::$app instanceof static) {
            static::$app = new static();
        }

        return static::$app;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function get($key = null)
    {
        return empty($key) ? $this->objects : $this->objects[$key];
    }

    /**
     * @param      $key
     * @param      $object
     * @param null $params
     *
     * @return object|void
     */
    public function set($key, $object, $params = null)
    {
        if ('raw' == $params) {
            return $this->rawSet($key, $object);
        }

        return $this->IoC($key, $object, $params);
    }

    /**
     * @param $key
     * @param $object
     */
    protected function rawSet($key, $object)
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
    protected function IoC($key, $object, $params = null)
    {
        $reflection  = new \ReflectionClass($object);
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
     * @param $key
     *
     * @return bool
     */
    public function has($key)
    {
        return isset($this->objects[$key]) ? true : false;
    }

    /**
     * @param $key
     * @param $param
     *
     * @return mixed
     */
    public function getParam($key, $param)
    {
        if ($this->has($key)) {
            if (isset($this->get($key)->$param)) {
                return $this->get($key)->$param;
            }
        }
    }

    /**
     * @param $key
     * @param $param
     * @param $value
     */
    public function setParam($key, $param, $value)
    {
        if (isset($this->objects[$key])) {
            $this->get($key)->$param = $value;
        }
    }

    /**
     * @param $key
     * @param $param
     *
     * @return mixed
     */
    public function hasParam($key, $param)
    {
        if ($this->has($key)) {
            return isset($this->get($key)->$param) ? true : false;
        }
    }

    /**
     * @param string $key
     *
     * @return string
     */
    public function getGet($key = null)
    {
        return empty($key) ? $this->get : $this->get[$key];
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
     * @param string $key
     *
     * @return string
     */
    public function getPost($key = null)
    {
        return empty($key) ? $this->post : $this->post[$key];
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
     * @param string      $key
     * @param string|null $subKey
     *
     * @return string
     */
    public function getSession(string $key, string $subKey = null): string
    {
        return empty($subKey) ? $_SESSION[$key] : $_SESSION[$key][$subKey];
    }

    /**
     * @param string      $key
     * @param string      $value
     * @param string|null $subKey
     */
    public function setSession(string $key, string $value, string $subKey = null)
    {
        if (empty($subKey)) {
            $_SESSION[$key] = $value;
        } else {
            $_SESSION[$key][$subKey] = $value;
        }
    }

    /**
     * @param string $key
     * @param string $subKey
     *
     * @return bool
     */
    public function hasSession(string $key, string $subKey): bool
    {
        return empty($subKey) ? isset($_SESSION[$key]) : isset($_SESSION[$key][$subKey]);
    }

    /**
     * @param string $key
     * @param string $subKey
     */
    public function unsetSession(string $key, string $subKey)
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
    public function startSession()
    {
        session_start();
    }

    /**
     * @codeCoverageIgnore
     */
    public function stopSession()
    {
        session_destroy();
    }

    public function clearSession()
    {
        $_SESSION = [];
    }

    /**
     * @param string $key
     * @param string $fieldName
     * @param string $formName
     *
     * @return string
     */
    public function getUpload(string $key, string $fieldName, $formName = 'upload') : string
    {
        return $this->files[$formName][$fieldName][$key];
    }

    /**
     * @param string $value
     * @param string $formName
     *
     * @return bool
     */
    public function isUploaded(string $value, $formName = 'upload') : bool
    {
        return ($this->files[$formName]['name'][$value] !== '');
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function isFileType(string $key) : bool
    {
        return ($this->files['type'] == $key) ? true : false;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function getCookie(string $key): string
    {
        return $_COOKIE[$key];
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function hasCookie(string $key): string
    {
        return isset($_COOKIE[$key]);
    }

    /**
     * @param string $key
     * @codeCoverageIgnore
     */
    public function unsetCookie(string $key)
    {
        unset($_COOKIE[$key]);
        setcookie($key, null, -1, '/');
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setCookie(string $key, string $value)
    {
        $_COOKIE[$key] = $value;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function getBinding($key)
    {
        return (isset($this->bind[$key])) ? $this->bind[$key] : $key;
    }

    /**
     * @param $key
     * @param $value
     */
    public function setBinding($key, $value)
    {
        $this->bind[$key] = $value;
    }

}
