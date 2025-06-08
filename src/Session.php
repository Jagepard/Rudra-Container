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
    public function get(string $id): mixed
    {
        return array_key_exists($id, $_SESSION)
            ? $_SESSION[$id]
            : throw new NotFoundException("Запись в сессии не найдена для идентификатора: \"$id\"");
    }

    public function set(array $data): void
    {
        count($data) === 2
            ? $this->processSessionData($data)
            : throw new \InvalidArgumentException("Массив содержит неверное количество элементов");
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

    public function unset(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public function setFlash(string $type, array $data): void
    {
        foreach ($data as $key => $value) {
            $this->set([$type, [$key => $value]]);
        }
    }

    public function start(): void
    {
        session_start();
    }

    public function stop(): void
    {
        session_destroy();
    }

    public function clear(): void
    {
        $_SESSION = [];
    }
}
