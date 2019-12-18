<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Interfaces\ContainerInterface;

class AbstractContainer implements ContainerInterface
{
    /**
     * @var array
     */
    protected $data;

    /**
     * AbstractRequestMethod constructor.
     * @param  array  $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

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
        $this->data = $data;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($this->data[$key]);
    }
}
