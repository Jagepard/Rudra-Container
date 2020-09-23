<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Abstracts\AbstractContainer;

class Container extends AbstractContainer
{
    protected array $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function get(string $key = null)
    {
        return empty($key) ? $this->data : $this->data[$key];
    }

    public function set(array $data): void
    {
        $this->data = array_merge($this->data, $data);
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }
}
