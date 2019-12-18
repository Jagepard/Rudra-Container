<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Interfaces\SessionInterface;

class Session  implements SessionInterface
{
    /**
     * @param string      $key
     * @param string|null $subKey
     * @return mixed
     */
    public function get(string $key, string $subKey = null)
    {
        return ($subKey === null) ? $_SESSION[$key] : $_SESSION[$key][$subKey];
    }

    /**
     * @param string      $key
     * @param             $value
     * @param string|null $subKey
     */
    public function set(string $key, $value, string $subKey = null): void
    {
        if (empty($subKey)) {
            $_SESSION[$key] = $value;
            return;
        }

        if ($subKey == 'increment') {
            $_SESSION[$key][] = $value;
            return;
        }

        $_SESSION[$key][$subKey] = $value;
    }

    /**
     * @param string      $key
     * @param string|null $subKey
     * @return bool
     */
    public function has(string $key, string $subKey = null): bool
    {
        return empty($subKey) ? isset($_SESSION[$key]) : isset($_SESSION[$key][$subKey]);
    }

    /**
     * @param string      $key
     * @param string|null $subKey
     */
    public function unset(string $key, string $subKey = null): void
    {
        if (empty($subKey)) {
            unset($_SESSION[$key]);
            return;
        }

        unset($_SESSION[$key][$subKey]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function start(): void
    {
        session_start();
    }

    /**
     * @codeCoverageIgnore
     */
    public function stop(): void
    {
        session_destroy();
    }

    public function clear(): void
    {
        $_SESSION = [];
    }
}
