<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Traits;

use ReflectionException;
use Psr\Container\ContainerInterface;

trait InstantiationsTrait
{
    private array $containers = [];

    /**
     * Creates a container instance
     * ----------------------------
     * Создает экземпляр контейнера
     *
     * @param  string $name
     * @param  string $instance
     * @param  array $data
     * @return ContainerInterface
     */
    private function containerize(string $name, string $instance, array $data = []): ContainerInterface
    {
        return $this->containers[$name] ??= new $instance($data);
    }

    /**
     * Initializes the service
     * -----------------------
     * Иницианализирует сервис
     *
     * @param  string $name
     * @param  string|null $instance
     * @param  array $data
     * @return mixed
     * @throws ReflectionException
     */
    private function init(string $name, string $instance = null, array $data = []): mixed
    {
        $instance ??= $name;
        !$this->has($name) && $this->set([$name, [$instance, $data]]);
        return $this->get($instance);
    }
}
