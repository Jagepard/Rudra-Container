<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Traits;

trait InstantiationsTrait
{
    private array $instances = [];

    private function instantiate(string $name, string $instance, $data = [])
    {
        if (!array_key_exists($name, $this->instances)) {
            $this->instances[$name] = new $instance($data);
        }

        return $this->instances[$name];
    }

    private function containerize(string $name, string $instance = null, $data = [])
    {
        $instance ??= $name;
        if (!array_key_exists($name, $this->data)) {
            $this->set([$name, [$instance, $data]]);
        }

        return $this->get($instance);
    }
}
