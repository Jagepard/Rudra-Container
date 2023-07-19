<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Traits;

trait InstantiationsTrait
{
    private array $containers = [];

    /**
     * @param  string $name
     * @param  string $instance
     * @param  array  $data
     * @return void
     * 
     * Creates a container instance
     * ----------------------------
     * Создает экземпляр контейнера
     */
    private function containerize(string $name, string $instance, $data = [])
    {
        if (!array_key_exists($name, $this->containers)) {
            $this->containers[$name] = new $instance($data);
        }

        return $this->containers[$name];
    }

    private function serviceCreation(string $name, string $instance = null, $data = [])
    {
        $instance ??= $name;
        if (!array_key_exists($name, $this->services)) {
            $this->set([$name, [$instance, $data]]);
        }

        return $this->get($instance);
    }
}
