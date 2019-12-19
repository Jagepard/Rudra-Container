<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

class Objects extends Container
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @param  array  $data
     * @throws \ReflectionException
     */
    public function set(array $data): void
    {
        var_dump($data);
        if (is_array($data[1]) && array_key_exists('params', $data[1])) {
            $this->setObject($data[0], $data[1], $data[1]['params']);
            return;
        }

        $this->setObject($data[0], $data[1]);
    }

    /**
     * @param  string  $key
     * @param $object
     * @param  null  $params
     * @throws \ReflectionException
     */
    private function setObject(string $key, $object, $params = null)
    {
        ('raw' === $params) ? $this->rawSet($key, $object) : $this->iOc($key, $object, $params);
    }

    /**
     * @param  string  $key
     * @param $object
     * @throws \ReflectionException
     */
    private function rawSet(string $key, $object)
    {
        $this->set([$key => $object]);
    }

    /**
     * @param  string  $key
     * @param        $object
     * @param  null  $params
     * @throws \ReflectionException
     */
    private function iOc(string $key, $object, $params = null): void
    {
        $reflection = new \ReflectionClass($object);
        $constructor = $reflection->getConstructor();

        if ($constructor && $constructor->getNumberOfParameters()) {
            $paramsIoC = $this->getParamsIoC($constructor, $params);
            $this->set([$key => $reflection->newInstanceArgs($paramsIoC)]);
            return;
        }

        $this->set([$key => new $object()]);
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
            if (isset($value->getClass()->name) && $this->hasBinding($value->getClass()->name)) {
                $className = $this->getBinding($value->getClass()->name);
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
     * @param  null  $params
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
