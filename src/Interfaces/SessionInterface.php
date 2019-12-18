<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

interface SessionInterface
{
    /**
     * @param string      $key
     * @param string|null $subKey
     * @return mixed
     */
    public function get(string $key, string $subKey = null);

    /**
     * @param string      $key
     * @param             $value
     * @param string|null $subKey
     */
    public function set(string $key, $value, string $subKey = null): void;

    /**
     * @param string      $key
     * @param string|null $subKey
     * @return bool
     */
    public function has(string $key, string $subKey = null): bool;

    /**
     * @param string      $key
     * @param string|null $subKey
     */
    public function unset(string $key, string $subKey = null): void;

    /**
     * @codeCoverageIgnore
     */
    public function start(): void;

    /**
     * @codeCoverageIgnore
     */
    public function stop(): void;

    public function clear(): void;
}
