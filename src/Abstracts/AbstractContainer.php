<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Abstracts;

abstract class AbstractContainer
{
    abstract public function get(string $key = null);
    abstract public function set(array $data): void;
    abstract public function has(string $key): bool;
}
