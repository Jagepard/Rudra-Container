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
 * @package Rudra
 */
class Container implements IContainer
{

    /**
     * @var array
     */
    protected $objects = [];

    /**
     * @var array
     */
    protected $post;

    /**
     * @var array
     */
    protected $get;

    /**
     * @var array
     */
    protected $server;

    /**
     * @var array
     */
    protected $files;

    public static $app;

    /**
     * Container constructor.
     */
    public function __construct()
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
        if (!static::$app instanceof static){
            static::$app = new static();
        }

        return static::$app;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key = null)
    {
        return empty($key) ? $this->objects : $this->objects[$key];
    }

    /**
     * @param $key
     * @param $object
     */
    public function set($key, $object)
    {
        $this->objects[$key] = $object;
    }

    /**
     * @param array $data
     */
    public function setAll(array $data)
    {
        foreach ($data as $key => $object) {
            $this->objects[$key] = $object;
        }

        App::set($this);
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
     * @return bool
     */
    public function has($key)
    {
        return isset($this->objects[$key]) ? true : false;
    }

    /**
     * @param $key
     * @param $param
     * @return mixed
     */
    public function getParam($key, $param)
    {
        if ($this->is($key)) {
            if (isset($this->get($key)->$param)) {
                return $this->get($key)->$param;
            }
        }
    }

    /**
     * @param string $key
     * @return string
     */
    public function getServer(string $key): string
    {
        return $this->server[$key];
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasPost(string $key): bool
    {
        return isset($this->post[$key]);
    }

    /**
     * @param string $key
     * @return string
     */
    public function getPost(string $key): string
    {
        return $this->post[$key];
    }

    /**
     * @return array
     */
    public function getAllPost()
    {
        return $this->post;
    }

    /**
     * @param $key
     * @param $value
     */
    public function setSession(string $key, string $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     * @param string $subKey
     * @param string $value
     */
    public function setSubSession(string $key, string $subKey, string $value)
    {
        $_SESSION[$key][$subKey] = $value;
    }

    /**
     * @param string $key
     */
    public function unsetSession(string $key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * @param string $key
     * @return string
     */
    public function getGet(string $key): string
    {
        return $this->get[$key];
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasGet(string $key): bool
    {
        return isset($this->get[$key]);
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
     * @param $value
     * @return bool
     */
    public function isUploaded(string $value, $formName = 'upload') : bool
    {
        return ($this->files['upload']['name'][$value] !== '');
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isFileType(string $key) : bool
    {
        return ($this->files['type'] == $key) ? true : false;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getSession(string $key): string
    {
        return $_SESSION[$key];
    }

    /**
     * @param string $key
     * @param string $subKey
     * @return string
     */
    public function getSubSession(string $key, string $subKey): string
    {
        return $_SESSION[$key][$subKey];
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasSession(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * @param string $key
     * @param string $subKey
     * @return bool
     */
    public function hasSubSession(string $key, string $subKey): bool
    {
        return isset($_SESSION[$key][$subKey]);
    }

    public function startSession()
    {
        session_start();
    }

    public function stopSession()
    {
        session_destroy();
    }

    public function clearSession()
    {
        $_SESSION = [];
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getCoockie(string $key): string
    {
        return $_COOKIE[$key];
    }

    /**
     * @param $key
     * @return mixed
     */
    public function hasCoockie(string $key): string
    {
        return isset($_COOKIE[$key]);
    }

    /**
     * @param string $key
     */
    public function unsetCoockie(string $key)
    {
        unset($_COOKIE[$key]);
        setcookie($key, null, -1, '/');
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setCoockie(string $key, string $value)
    {
        $_COOKIE[$key]= $value;
    }

}
