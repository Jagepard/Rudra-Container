<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Psr\Container\ContainerInterface;
use Rudra\Exceptions\NotFoundException;

class Cookie implements ContainerInterface
{
    public function get(string $id): mixed
    {
        return array_key_exists($id, $_COOKIE)
            ? $_COOKIE[$id]
            : throw new NotFoundException("Куки с идентификатором \"$id\" не найдено.");
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $_COOKIE);
    }

    public function unset(string $id): void
    {
        array_key_exists($id, $_COOKIE)
            ? $this->deleteCookie($id)
            : throw new NotFoundException("Куки с идентификатором \"$id\" не найдено.");
    }

    private function deleteCookie(string $id): void
    {
        unset($_COOKIE[$id]);
        setcookie($id, '', -1, '/');
    }

    public function set(array $data): void
    {
        count($data) === 2
            ? $this->processCookieData($data)
            : throw new \InvalidArgumentException("Массив содержит неверное количество элементов.");
    }

    private function processCookieData(array $data): void
    {
        is_array($data[1])
            ? setcookie($data[0], $data[1][0], $data[1][1], '/')
            : setcookie($data[0], $data[1]);
    }
}
