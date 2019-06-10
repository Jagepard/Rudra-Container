<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Interfaces;

interface ContainerCookieInterface
{
    /**
     * @param string $key
     * @return string
     */
    public function getCookie(string $key): string;

    /**
     * @param string $key
     * @return bool
     */
    public function hasCookie(string $key): bool;

    /**
     * @codeCoverageIgnore
     * @param string $key
     */
    public function unsetCookie(string $key): void;

    /**
     * @param string $key
     * @param string $value
     */
    public function setCookie(string $key, string $value): void;
}
