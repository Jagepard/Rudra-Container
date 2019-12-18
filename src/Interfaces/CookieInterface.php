<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

interface CookieInterface
{
    /**
     * @param string $key
     * @return string
     */
    public function get(string $key): string;

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * @codeCoverageIgnore
     * @param string $key
     */
    public function unset(string $key): void;

    /**
     * @param string $key
     * @param string $value
     */
    public function set(string $key, string $value): void;
}
