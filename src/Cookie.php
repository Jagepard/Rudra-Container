<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Psr\Container\{
    ContainerInterface, 
    NotFoundExceptionInterface, 
    ContainerExceptionInterface
}; 

class Cookie implements ContainerInterface
{
    /**
     * Gets an element by id
     * -------------------------
     * Получает элемент по id
     *
     * @param  string|null $id
     * @return mixed
     */
    public function get(string $id): mixed
    {
        if (!array_key_exists($id, $_COOKIE)) {
            throw new \InvalidArgumentException("No data corresponding to the $id");
        }

        return $_COOKIE[$id];
    }

    /**
     * Checks for the existence of data by key
     * ---------------------------------------
     * Проверяет наличие данных по ключу
     *
     * @param  string  $key
     * @return boolean
     */
    public function has(string $id): bool
    {
        return !empty($id) && array_key_exists($id, $_COOKIE);
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
            setcookie($data[0], $data[1][0], $data[1][1], '/');
        }
    }
}
