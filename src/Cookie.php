<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Interfaces\ContainerInterface;

class Cookie implements ContainerInterface
{
    /**
     * Gets an element by key or the entire array of data
     * --------------------------------------------------
     * Получает элемент по ключу или весь массив данных
     *
     * @param  string|null $key
     * @return mixed
     */
    public function get(string $key = null): mixed
    {
        if (empty($key)) {
            return $_COOKIE;
        }

        if (!array_key_exists($key, $_COOKIE)) {
            throw new \InvalidArgumentException("No data corresponding to the $key");
        }

        return $_COOKIE[$key];
    }

    /**
     * Checks for the existence of data by key
     * ---------------------------------------
     * Проверяет наличие данных по ключу
     *
     * @param  string  $key
     * @return boolean
     */
    public function has(string $key): bool
    {
        return isset($_COOKIE[$key]);
    }

    /**
     * Unset a given variable
     * ----------------------
     * Удаляет переменную
     * 
     * @param  string $key
     * @return void
     * 
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

    /**
     * Sets data
     * ---------
     * Устанавливает данные
     *
     * @param  array $data
     * @return void
     */
    public function set(array $data): void
    {
        if (count($data) !== 2) {
            throw new \InvalidArgumentException("The array contains the wrong number of elements");
        }

        if (!is_array($data[1])) {
            setcookie($data[0], $data[1]);
        } else {
            setcookie($data[0], $data[1][0], $data[1][1]);
        }
    }
}
