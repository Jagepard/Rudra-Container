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
    /**
     * Gets an element by key or the entire array of data
     * --------------------------------------------------
     * Получает элемент по ключу или весь массив данных
     *
     * @param string|null $key
     * @return mixed
     */
    public function get(string $key = null): mixed
    {
        if (empty($key)) {
            return $_SESSION;
        }

        if (!array_key_exists($key, $_SESSION)) {
            throw new \InvalidArgumentException("No data corresponding to the $key");
        }

        return $_SESSION[$key];
    }

    /**
     * Sets session data
     * -----------------
     * Устанавливает данные сессии
     *
     * @param array $data
     * @return void
     */
    public function set(array $data): void
    {
        if (count($data) !== 2) {
            throw new \InvalidArgumentException("The array contains the wrong number of elements");
        }

        if (array_key_exists($data[0], $_SESSION) && is_array($_SESSION[$data[0]])) {
            array_merge($_SESSION[$data[0]], $data[1]);
        } else {
            $_SESSION[$data[0]] = $data[1];
        }
    }

    /**
     * Checks for the existence of data by key
     * ---------------------------------------
     * Проверяет наличие данных по ключу
     *
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Unset a given variable from array
     * ---------------------------------
     * Удаляет переменную из массива
     *
     * @param  string $key
     * @return void
     */
    public function unset(string $key): void
    {
        unset($_SESSION[$key]);
    }

    /**
     * @param string $type
     * @param array $data
     * @return void
     */
    public function setFlash(string $type, array $data): void
    {
        foreach ($data as $key => $value) {
            $this->set([$type, [$key => $value]]);
        }
    }

    /**
     * Start new or resume existing session
     * ------------------------------------
     * Стартует новую сессию, либо возобновляет существующую
     *
     * @return void
     * 
     * @codeCoverageIgnore
     */
    public function start(): void
    {
        session_start();
    }

    /**
     * Destroys all data registered to a session
     * -----------------------------------------
     * Уничтожает все данные сессии 
     *
     * @return void
     * 
     * @codeCoverageIgnore
     */
    public function stop(): void
    {
        session_destroy();
    }

    /**
     * Clears the $_SESSION array
     * --------------------------
     * Очищает массив $_SESSION
     *
     * @return void
     */
    public function clear(): void
    {
        $_SESSION = [];
    }
}
