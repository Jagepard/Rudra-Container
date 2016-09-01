<?php

namespace Rudra;

    /**
     * Date: 25.08.2016
     * Time: 14:50
     * @author    : Korotkov Danila <dankorot@gmail.com>
     * @copyright Copyright (c) 2016, Korotkov Danila
     * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
     */

/**
 * Class Application
 * @package Core
 */
class Container implements iContainer
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
     * Container constructor.
     */
    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->objects[$key];
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
    public function is($key)
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
}
