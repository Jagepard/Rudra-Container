<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Interfaces\ContainerInterface;

class Cookie implements ContainerInterface
{
    /**
     * @param  string  $key
     * @return array|mixed
     */
    public function get(string $key = null)
    {
        if (!array_key_exists($key, $_COOKIE)) {
            throw new \InvalidArgumentException('no data corresponding to the key');
        }

        return empty($key) ? $_COOKIE : $_COOKIE[$key];
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($_COOKIE[$key]);
    }

    /**
     * @codeCoverageIgnore
     * @param string $key
     */
    public function unset(string $key): void
    {
        if (!array_key_exists($key, $_COOKIE)) {
            throw new \InvalidArgumentException('no data corresponding to the key');
        }

        unset($_COOKIE[$key]);
        setcookie($key, '', -1, '/');
    }

    /**
     * @param  array  $data
     */
    public function set(array $data): void
    {
        if (count($data) !== 2) {
            throw new \InvalidArgumentException('the array contains the wrong number of elements');
        }

        $_COOKIE[$data[0]] = $data[1];
    }
}
