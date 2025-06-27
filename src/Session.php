<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Psr\Container\ContainerInterface;
use Rudra\Exceptions\NotFoundException;

class Session implements ContainerInterface
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
    public function set(array $data): void
    {
        count($data) === 2
            ? $this->processSessionData($data)
            : throw new \InvalidArgumentException("Массив содержит неверное количество элементов");
    }

    /**
     * Processes session data by merging or setting values.
     * If the key already exists and is an array, merges the new data.
     * Otherwise, sets the new value directly.
     * -------------------------
     * Обрабатывает данные сессии, объединяя или устанавливая значения.
     * Если ключ уже существует и является массивом, объединяет новые данные.
     * В противном случае устанавливает новое значение напрямую.
     *
     * @param  array $data
     * @return void
     */
    private function processSessionData(array $data): void
    {
        is_array($_SESSION[$data[0]] ?? null)
            ? $_SESSION[$data[0]] = array_merge($_SESSION[$data[0]], $data[1])
            : $_SESSION[$data[0]] = $data[1];
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
    public function unset(string $key): void
    {
        unset($_SESSION[$key]);
    }

    /**
     * Sets flash messages in the session.
     * Iterates through the provided data and sets each key-value pair as session data.
     * -------------------------
     * Устанавливает флеш-сообщения в сессии.
     * Перебирает предоставленные данные и устанавливает каждую пару ключ-значение как данные сессии.
     *
     * @param  string $type
     * @param  array  $data
     * @return void
     */
    public function setFlash(string $type, array $data): void
    {
        foreach ($data as $key => $value) {
            $this->set([$type, [$key => $value]]);
        }
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
