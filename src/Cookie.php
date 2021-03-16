<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Interfaces\ContainerInterface;
use Psr\Container\ContainerInterface as PsrContainerInterface;

class Cookie implements ContainerInterface, PsrContainerInterface
{
    public function get(string $key = null)
    {
        if (empty($key)) {
            return $_COOKIE;
        }

        if (!array_key_exists($key, $_COOKIE)) {
            throw new \InvalidArgumentException("No data corresponding to the $key");
        }

        return $_COOKIE[$key];
    }

    public function has(string $key): bool
    {
        return isset($_COOKIE[$key]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function unset(string $key): void
    {
        if (!array_key_exists($key, $_COOKIE)) {
            throw new \InvalidArgumentException("No data corresponding to the $key");
        }

        unset($_COOKIE[$key]);
        setcookie($key, '', -1, '/');
    }

    public function set(array $data): void
    {
        if (count($data) !== 2) {
            throw new \InvalidArgumentException("The array contains the wrong number of elements");
        }

        if (!is_array($data[1])) setcookie($data[0], $data[1]);

        setcookie($data[0], $data[1][0], $data[1][1]);
    }
}
