<?php

declare(strict_types = 1);

/**
 * Date: 06.04.17
 * Time: 14:55
 *
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2016, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra;

/**
 * Class ContainerCookieTrait
 *
 * @package Rudra
 */
trait ContainerCookieTrait
{

    /**
     * @param string $key
     *
     * @return string
     */
    public function getCookie(string $key): string
    {
        return $_COOKIE[$key];
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasCookie(string $key): bool
    {
        return isset($_COOKIE[$key]);
    }

    /**
     * @codeCoverageIgnore
     *
     * @param string $key
     */
    public function unsetCookie(string $key): void
    {
        unset($_COOKIE[$key]);
        setcookie($key, null, -1, '/');
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