<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Interfaces\{ApplicationInterface, ContainerInterface, RequestInterface, ResponseInterface};

class Application implements ApplicationInterface
{
    /**
     * @var ApplicationInterface
     */
    public static $application;
    /**
     * @var array
     */
    private $instances = [];

    /**
     * @return ApplicationInterface
     */
    public static function run(): ApplicationInterface
    {
        if (!static::$application instanceof static) {
            static::$application = new static();
        }

        return static::$application;
    }

    /**
     * @param  array  $services
     * @throws \ReflectionException
     */
    public function setServices(array $services): void
    {
        foreach ($services['contracts'] as $interface => $contract) {
            $this->binding()->set([$interface, $contract]);
        }

        foreach ($services['services'] as $name => $service) {
            $this->objects()->set([$name, $service]);
        }
    }

    /**
     * @return ContainerInterface
     */
    public function objects(): ContainerInterface
    {
        return $this->instantiate('objects', Objects::class);
    }

    /**
     * @return RequestInterface
     */
    public function request(): RequestInterface
    {
        return $this->instantiate('request', Request::class);
    }

    /**
     * @return ContainerInterface
     */
    public function cookie(): ContainerInterface
    {
        return $this->instantiate('cookie', Cookie::class);
    }

    /**
     * @return ContainerInterface
     */
    public function session(): ContainerInterface
    {
        return $this->instantiate('session', Session::class);
    }

    /**
     * @return ResponseInterface
     */
    public function response(): ResponseInterface
    {
        return $this->instantiate('response', Response::class);
    }

    /**
     * @return ContainerInterface
     */
    public function config(): ContainerInterface
    {
        return $this->instantiate('config', Container::class);
    }

    /**
     * @return ContainerInterface
     */
    public function binding(): ContainerInterface
    {
        return $this->instantiate('binding', Container::class);
    }

    /**
     * @return ContainerInterface
     */
    public function parameters(): ContainerInterface
    {
        return $this->instantiate('parameters', Container::class);
    }

    /**
     * @param $varName
     * @param $instance
     * @return mixed
     */
    private function instantiate($varName, $instance)
    {
        if (!array_key_exists($varName, $this->instances)) {
            $this->instances[$varName] = new $instance();
        }

        return $this->instances[$varName];
    }

//    /**
//     * @param  string|null  $key
//     * @return array
//     */
//    public function get(string $key = null)
//    {
//        return (empty($key)) ? $this->objects()->get() : $this->objects()->get($key);
//    }
//
//    /**
//     * @param  array  $data
//     * @throws \ReflectionException
//     */
//    public function set(array $data): void
//    {
//        if (is_array($data[1]) && array_key_exists('params', $data[1])) {
//            $this->setObject($data[0], $data[1], $data[1]['params']);
//            return;
//        }
//
//        $this->setObject($data[0], $data[1]);
//    }
//
//    /**
//     * @param  string  $key
//     * @return bool
//     */
//    public function has(string $key): bool
//    {
//        return isset($this->objects[$key]);
//    }

//    /**
//     * @param  string  $key
//     * @param  string  $param
//     * @return mixed
//     */
//    public function getParam(string $key, string $param)
//    {
//        if ($this->has($key) && isset($this->get($key)->$param)) {
//            return $this->get($key)->$param;
//        }
//    }
//
//    /**
//     * @param  string  $key
//     * @param  string  $param
//     * @param        $value
//     */
//    public function setParam(string $key, string $param, $value): void
//    {
//        if (isset($this->objects[$key])) {
//            $this->get($key)->$param = $value;
//        }
//    }
//
//    /**
//     * @param  string  $key
//     * @param  string  $param
//     * @return bool
//     */
//    public function hasParam(string $key, string $param)
//    {
//        if ($this->has($key)) {
//            return isset($this->get($key)->$param);
//        }
//    }

//    /**
//     * @param  string  $key
//     * @return mixed|string
//     */
//    public function getBinding(string $key)
//    {
//        return $this->bind[$key] ?? $key;
//    }
//
//    /**
//     * @param  string  $key
//     * @return bool
//     */
//    public function hasBinding(string $key): bool
//    {
//        return array_key_exists($key, $this->bind);
//    }
//
//    /**
//     * @param  string  $key
//     * @param        $value
//     */
//    public function setBinding(string $key, $value): void
//    {
//        $this->bind[$key] = $value;
//    }
}
