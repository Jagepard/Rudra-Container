<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Interfaces\ContainerInterface;

class Session implements ContainerInterface
{
    public function get(string $key = null)
    {
        if (empty($key)) {
            return $_SESSION;
        }

        if (!array_key_exists($key, $_SESSION)) {
            throw new \InvalidArgumentException("No data corresponding to the $key");
        }

        return $_SESSION[$key];
    }

    public function set(array $data): void
    {
        if (count($data) !== 2) {
            throw new \InvalidArgumentException("The array contains the wrong number of elements");
        }

        $_SESSION[$data[0]] = $data[1];
    }

    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function unset(string $key): void
    {
        unset($_SESSION[$key]);
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
