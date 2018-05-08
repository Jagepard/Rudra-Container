<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPL-3.0
 */

namespace Rudra\Container\Interfaces;

/**
 * Interface ContainerCookieInterface
 * @package Rudra
 */
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