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
 * Class ContainerInterface
 *
 * @package Rudra
 */
class Container implements ContainerInterface
{

    use ContainerCookieTrait;
    use ContainerGlobalsTrait;
    use ContainerSessionTrait;
    use ContainerConfigTrait;
    use ContainerResponseTrait;

    /**
     * @var ContainerInterface
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
     * @return ContainerInterface
     */
    public static function app(): ContainerInterface
    {
        if (!static::$app instanceof static) {
            session_name("RudraFramework");
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

        return $this->iOc($key, $object, $params);
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
    protected function iOc(string $key, $object, $params = null)
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
