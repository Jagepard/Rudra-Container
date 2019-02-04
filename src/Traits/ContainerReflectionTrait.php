<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra\Traits;

use \ReflectionClass;
use \ReflectionMethod;

/**
 * Trait ContainerReflectionTrait
 * @package Rudra
 */
trait ContainerReflectionTrait
{

    /**
     * @var array
     */
    private $objects = [];
    /**
     * @var array
     */
    private $bind = [];

    /**
     * @param string $key
     * @param        $object
     */
    private function rawSet(string $key, $object)
    {
        $this->objects[$key] = $object;
    }

    /**
     * @param string $key
     * @param        $object
     * @param null   $params
     * @throws \ReflectionException
     */
    private function iOc(string $key, $object, $params = null): void
    {
        $reflection  = new ReflectionClass($object);
        $constructor = $reflection->getConstructor();

        if ($constructor && $constructor->getNumberOfParameters()) {
            $paramsIoC           = $this->getParamsIoC($constructor, $params);
            $this->objects[$key] = $reflection->newInstanceArgs($paramsIoC);
            return;
        }

        $this->objects[$key] = new $object;
    }

    /**
     * @param      $object
     * @param null $params
     * @return object
     * @throws \ReflectionException
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
     * @param ReflectionMethod $constructor
     * @param                  $params
     * @return array
     * @throws \ReflectionException
     */
    private function getParamsIoC(ReflectionMethod $constructor, $params): array
    {
        $i         = 0;
        $paramsIoC = [];

        foreach ($constructor->getParameters() as $value) {

            if (isset($value->getClass()->name) && $this->hasBinding($value->getClass()->name)) {
                $className   = $this->getBinding($value->getClass()->name);
                $paramsIoC[] = (is_object($className)) ? $className : new $className;
                continue;
            }

            if ($value->isDefaultValueAvailable() && !isset($params[$i])) {
                $paramsIoC[] = $value->getDefaultValue();
                continue;
            }

            $paramsIoC[] = $params[$i++];
        }

        return $paramsIoC;
    }


    /**
     * @param string|null $key
     * @return array|mixed
     */
    public function get(string $key = null)
    {
        return (empty($key)) ? $this->objects : $this->objects[$key];
    }

    /**
     * @param string $key
     * @param        $object
     * @param null   $params
     * @throws \ReflectionException
     */
    public function set(string $key, $object, $params = null)
    {
        ('raw' == $params) ? $this->rawSet($key, $object) : $this->iOc($key, $object, $params);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($this->objects[$key]);
    }

    /**
     * @param string $key
     * @param string $param
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
     * @return mixed|string
     */
    public function getBinding(string $key)
    {
        return $this->bind[$key] ?? $key;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasBinding(string $key): bool
    {
        return array_key_exists($key, $this->bind);
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
