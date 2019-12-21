<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Interfaces\ContainerInterface;

class Objects extends Container
{
    /**
     * @var ContainerInterface
     */
    private $binding;

    /**
     * Objects constructor.
     * @param $binding
     */
    public function __construct(ContainerInterface $binding)
    {
        $this->binding = $binding;
    }

    /**
     * @param  array  $data
     * @throws \ReflectionException
     */
    public function set(array $data): void
    {
        list($key, $object) = $data;

        if (is_array($object) && array_key_exists(1, $object)) {
            ('raw' === $object[1]) ? $this->mergeData($key, $object[0]) : $this->iOc($key, $object[0], $object[1]);
            return;
        }

        $this->iOc($key, $object);
    }

    /**
     * @param  string  $key
     * @param $object
     * @throws \ReflectionException
     */
    private function mergeData(string $key, $object)
    {
        $this->data = array_merge([$key => $object], $this->data);
    }

    /**
     * @param  string  $key
     * @param        $object
     * @param        $params
     * @throws \ReflectionException
     */
    private function iOc(string $key, $object, $params = null): void
    {
        $reflection = new \ReflectionClass($object);
        $constructor = $reflection->getConstructor();

        if ($constructor && $constructor->getNumberOfParameters()) {
            $paramsIoC = $this->getParamsIoC($constructor, $params);
            $this->mergeData($key, $reflection->newInstanceArgs($paramsIoC));
            return;
        }

        $this->mergeData($key, new $object());
    }


    /**
     * @param  \ReflectionMethod  $constructor
     * @param                  $params
     * @return array
     * @throws \ReflectionException
     */
    private function getParamsIoC(\ReflectionMethod $constructor, $params): array
    {
        $i = 0;
        $paramsIoC = [];

        foreach ($constructor->getParameters() as $value) {
            if (isset($value->getClass()->name) && $this->binding->has($value->getClass()->name)) {
                $className = $this->binding->get($value->getClass()->name);
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
     * @param      $object
     * @param      $params
     * @return object
     * @throws \ReflectionException
     */
    public function new($object, $params = null)
    {
        $reflection = new \ReflectionClass($object);
        $constructor = $reflection->getConstructor();

        if ($constructor && $constructor->getNumberOfParameters()) {
            $paramsIoC = $this->getParamsIoC($constructor, $params);

            return $reflection->newInstanceArgs($paramsIoC);
        }

        return new $object();
    }
}
