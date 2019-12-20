<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Interfaces\ContainerInterface;

class Container implements ContainerInterface
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param string|null $key
     * @return array
     */
    public function get(string $key = null)
    {
        return empty($key) ? $this->data : $this->data[$key];
    }

    /**
     * @param array $data
     */
    public function set(array $data): void
    {
        $this->data = array_merge($data, $this->data);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }
}
