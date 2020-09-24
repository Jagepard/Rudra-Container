<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Abstracts;

interface ContainerInterface
{
    public function get(string $key = null);
    public function set(array $data): void;
    public function has(string $key): bool;
}
