<?php

/**
 * Date: 16.02.17
 * Time: 12:31
 *
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2016, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra;

use App\Config\Config;

/**
 * Class InversionOfControl
 *
 * @package Rudra
 */
trait InversionOfControl
{

    /**
     * @param      $object
     * @param null $params
     *
     * @return object
     */
    public function new($object, $params = null)
    {
        $reflection  = new \ReflectionClass($object);
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

    protected function getParamsIoC($constructor, $params)
    {
        $paramsIoC = [];
        foreach ($constructor->getParameters() as $key => $value) {
            if (isset($value->getClass()->name)) {
                $className = $this->getBinding($value->getClass()->name);
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
     * @return mixed
     */
    protected function getBinding($key)
    {
        return (isset(Config::$bind[$key])) ? Config::$bind[$key] : $key;
    }

    /**
     * @param $key
     * @param $value
     */
    protected function setBinding($key, $value)
    {
        Config::$bind[$key] = $value;
    }

}
