<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Interfaces\CookieInterface;

class Cookie implements CookieInterface
{
    /**
     * @param string $key
     * @return string
     */
    public function get(string $key): string
    {
        return $_COOKIE[$key];
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($_COOKIE[$key]);
    }

    /**
     * @codeCoverageIgnore
     * @param string $key
     */
    public function unset(string $key): void
    {
        unset($_COOKIE[$key]);
        setcookie($key, '', -1, '/');
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function set(string $key, string $value): void
    {
        $_COOKIE[$key] = $value;
    }
}