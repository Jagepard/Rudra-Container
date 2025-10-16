<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Exceptions\NotFoundException;

class Session
{
    /**
     * @param  string $id
     * @return mixed
     */
    public function get(string $id): mixed
    {
        return array_key_exists($id, $_SESSION)
            ? $_SESSION[$id]
            : throw new NotFoundException("Запись в сессии не найдена для идентификатора: \"$id\"");
    }

    /**
     * @param  array $data
     * @return void
     */
    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param  string  $id
     * @return boolean
     */
    public function has(string $id): bool
    {
        return array_key_exists($id, $_SESSION);
    }

    /**
     * @param  string $key
     * @return void
     */
    public function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    /**
     * @return void
     */
    public function start(): void
    {
        session_start();
    }

    /**
     * @return void
     */
    public function stop(): void
    {
        session_destroy();
    }

    /**
     * @return void
     */
    public function clear(): void
    {
        $_SESSION = [];
    }
}
