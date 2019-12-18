<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

interface ContainerInterface
{
    /**
     * @param string|null $key
     * @return array
     */
    public function get(string $key);

    /**
     * @param array $data
     */
    public function set(array $data): void;

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;
}
