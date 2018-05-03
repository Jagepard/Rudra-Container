<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra;


use \ReflectionClass;


/**
 * Class ContainerInterface
 *
 * @package Rudra
 */
class Container implements ContainerInterface, ContainerGlobalScopeInterface
{

    use ContainerReflectionTrait;
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
            static::$app = new static();
        }

        return static::$app;
    }

    /**
     * @param $app
     */
    public function setServices(array $app): void
    {
        foreach ($app['contracts'] as $interface => $contract) {
            $this->setBinding($interface, $contract);
        }

        foreach ($app['services'] as $name => $service) {
            if (array_key_exists(1, $service)) {
                $this->set($name, $service[0], $service[1]);
                continue;
            }

            $this->set($name, $service[0]);
        }
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function get(string $key = null)
    {
        return (empty($key)) ? $this->objects : $this->objects[$key];
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
        ('raw' == $params) ? $this->rawSet($key, $object) : $this->iOc($key, $object, $params);
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

        if ($constructor && $constructor->getNumberOfParameters()) {
            $paramsIoC = $this->getParamsIoC($constructor, $params);

            return $reflection->newInstanceArgs($paramsIoC);
        }

        return new $object;
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($this->objects[$key]);
    }

    /**
     * @param string $key
     * @param string $param
     *
     * @return mixed
     */
    public function getParam(string $key, string $param)
    {
        if ($this->has($key) && isset($this->get($key)->$param)) {
            return $this->get($key)->$param;
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
            return isset($this->get($key)->$param);
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
