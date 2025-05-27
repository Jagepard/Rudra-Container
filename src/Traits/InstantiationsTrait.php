<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Container\Traits;

use ReflectionException;
use Psr\Container\ContainerInterface;

trait InstantiationsTrait
{
    private array $containers = [];

    private function containerize(string $name, string $instance, array $data = []): ContainerInterface
    {
        return $this->containers[$name] ??= new $instance($data);
    }

    private function init(string $name, string $instance = null, array $data = []): mixed
    {
        $instance ??= $name;
        !$this->has($name) && $this->set([$name, [$instance, $data]]);
        return $this->get($instance);
    }
}
