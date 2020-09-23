<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Abstracts\AbstractContainer;

class Cookie extends AbstractContainer
{
    public function get(string $key = null)
    {
        if (empty($key)) {
            return $_COOKIE;
        }

        if (!array_key_exists($key, $_COOKIE)) {
            throw new \InvalidArgumentException("No data corresponding to the key");
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
            throw new \InvalidArgumentException("No data corresponding to the key");
        }

        unset($_COOKIE[$key]);
        setcookie($key, '', -1, '/');
    }

    public function set(array $data): void
    {
        if (count($data) !== 2) {
            throw new \InvalidArgumentException("The array contains the wrong number of elements");
        }

        $_COOKIE[$data[0]] = $data[1];
    }
}
