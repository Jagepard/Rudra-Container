<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Traits;

trait ContainerCookieTrait // implements ContainerCookieInterface // PHP RFC: Traits with interfaces
{
    /**
     * @param string $key
     * @return string
     */
    public function getCookie(string $key): string
    {
        return $_COOKIE[$key];
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasCookie(string $key): bool
    {
        return isset($_COOKIE[$key]);
    }

    /**
     * @codeCoverageIgnore
     * @param string $key
     */
    public function unsetCookie(string $key): void
    {
        unset($_COOKIE[$key]);
        setcookie($key, '', -1, '/');
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setCookie(string $key, string $value): void
    {
        $_COOKIE[$key] = $value;
    }
}
