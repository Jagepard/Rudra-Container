<?php
/**
 * Date: 03.05.18
 * Time: 18:23
 *
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra;


use \ReflectionClass;
use \ReflectionMethod;


/**
 * Trait ContainerReflectionTrait
 * @package Rudra
 */
trait ContainerReflectionTrait
{

    /**
     * @param string $key
     * @param        $object
     */
    protected function rawSet(string $key, $object)
    {
        $this->objects[$key] = $object;
    }

    /**
     * @param string $key
     * @param        $object
     * @param null   $params
     */
    protected function iOc(string $key, $object, $params = null): void
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
     * @param ReflectionMethod $constructor
     * @param                  $params
     * @return array
     */
    protected function getParamsIoC(ReflectionMethod $constructor, $params): array
    {
        $paramsIoC = [];
        foreach ($constructor->getParameters() as $key => $value) {
            if (isset($value->getClass()->name)) {
                $className       = $this->getBinding($value->getClass()->name);
                $paramsIoC[$key] = (is_object($className)) ? $className : new $className;
                continue;
            }

            if ($value->isDefaultValueAvailable()) {
                $paramsIoC[$key] = $value->getDefaultValue();
                continue;
            }

            $paramsIoC[$key] = $params[$value->getName()];
        }

        return $paramsIoC;
    }
}