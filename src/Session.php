<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Psr\Container\ContainerInterface;
use Rudra\Container\Exceptions\NotFoundException;

class Session implements ContainerInterface
{
    public function get(string $id): mixed
    {
        return array_key_exists($id, $_SESSION)
            ? $_SESSION[$id]
            : throw new NotFoundException("Session entry not found for id: \"$id\"");
    }

    public function set(array $data): void
    {
        count($data) === 2
            ? $this->processSessionData($data)
            : throw new \InvalidArgumentException("The array contains the wrong number of elements");
    }

    private function processSessionData(array $data): void
    {
        is_array($_SESSION[$data[0]] ?? null)
            ? $_SESSION[$data[0]] = array_merge($_SESSION[$data[0]], $data[1])
            : $_SESSION[$data[0]] = $data[1];
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $_SESSION);
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
