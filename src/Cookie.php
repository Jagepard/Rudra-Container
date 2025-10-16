<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Exceptions\NotFoundException;

class Cookie
{
    /**
     * Возвращает значение куки по ключу.
     *
     * @param string $id
     * @return mixed
     * @throws NotFoundException
     */
    public function get(string $id): mixed
    {
        if (!array_key_exists($id, $_COOKIE)) {
            throw new NotFoundException("Куки с идентификатором \"$id\" не найдено.");
        }
        return $_COOKIE[$id];
    }

    /**
     * Проверяет, существует ли куки.
     *
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return array_key_exists($id, $_COOKIE);
    }

    /**
     * Удаляет куки.
     *
     * @param string $id
     * @return void
     * @throws NotFoundException
     */
    public function remove(string $id): void // Переименовано с unset
    {
        if (!array_key_exists($id, $_COOKIE)) {
            throw new NotFoundException("Куки с идентификатором \"$id\" не найдено.");
        }
        $this->deleteCookie($id);
    }

    /**
     * Удаляет куки из суперглобального массива и отправляет заголовок для удаления в браузере.
     *
     * @param string $id
     * @return void
     */
    private function deleteCookie(string $id): void
    {
        unset($_COOKIE[$id]);
        setcookie($id, '', time() - 3600, '/'); // Установить время в прошлое
    }

    /**
     * Устанавливает куки.
     *
     * @param string $key Имя куки.
     * @param string $value Значение куки.
     * @param int $expire Время жизни (timestamp). По умолчанию 0 (до закрытия браузера).
     * @param string $path Путь на сервере. По умолчанию '/'.
     * @param string|null $domain Домен. По умолчанию null (текущий хост).
     * @param bool $secure Использовать HTTPS. По умолчанию false.
     * @param bool $httponly Запретить доступ через JS. По умолчанию false.
     * @param string $samesite Значение SameSite. По умолчанию 'Lax'.
     * @return void
     */
    public function set(
        string $key,
        string $value,
        int $expire = 0,
        string $path = '/',
        ?string $domain = null,
        bool $secure = false,
        bool $httponly = false,
        string $samesite = 'Lax'
    ): void {
        $_COOKIE[$key] = $value;

        // Используем setcookie с полным набором параметров для безопасности
        setcookie($key, $value, [
            'expires'  => $expire,
            'path'     => $path,
            'domain'   => $domain,
            'secure'   => $secure,
            'httponly' => $httponly,
            'samesite' => $samesite,
        ]);
    }
}
