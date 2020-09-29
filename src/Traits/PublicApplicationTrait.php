<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Traits;

use Rudra\Container\{
    Abstracts\AbstractRequest, Abstracts\AbstractResponse, Abstracts\ContainerInterface, Cookie, Rudra, Session
};

trait PublicApplicationTrait
{
    public function setServices(array $services): void
    {
        $this->_setServices($services);
    }

    public function binding(): ContainerInterface
    {
        return $this->_binding();
    }

    public function services(): ContainerInterface
    {
        return $this->_services();
    }

    public function config(): ContainerInterface
    {
        return $this->_config();
    }

    public function request(): AbstractRequest
    {
        return $this->_request();
    }

    public function response(): AbstractResponse
    {
        return $this->_response();
    }

    public function cookie(): Cookie
    {
        return $this->_cookie();
    }

    public function session(): Session
    {
        return $this->_session();
    }

    /*
     | Creates an object without adding to the container
     */
    public function new($object, $params = null)
    {
        return new $this->_new($object, $params);
    }

    public function get(string $key = null)
    {
        return $this->_get($key);
    }

    public function set(array $data): void
    {
        $this->_set($data);
    }

    public function has(string $key): bool
    {
        return $this->_has($key);
    }


    public function __call($method, $parameters) {
        return $this->$method(...$parameters);
    }

    public static function __callStatic($method, $parameters)
    {
        return Rudra::run()->$method(...$parameters);
    }
}
