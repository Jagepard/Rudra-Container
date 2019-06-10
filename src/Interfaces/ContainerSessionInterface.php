<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Interfaces;

interface ContainerSessionInterface
{
    /**
     * @param string      $key
     * @param string|null $subKey
     * @return mixed
     */
    public function getSession(string $key, string $subKey = null);

    /**
     * @param string      $key
     * @param             $value
     * @param string|null $subKey
     */
    public function setSession(string $key, $value, string $subKey = null): void;

    /**
     * @param string      $key
     * @param string|null $subKey
     * @return bool
     */
    public function hasSession(string $key, string $subKey = null): bool;

    /**
     * @param string      $key
     * @param string|null $subKey
     */
    public function unsetSession(string $key, string $subKey = null): void;

    /**
     * @codeCoverageIgnore
     */
    public function startSession(): void;

    /**
     * @codeCoverageIgnore
     */
    public function stopSession(): void;

    public function clearSession(): void;
}
