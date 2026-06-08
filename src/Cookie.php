<?php declare(strict_types=1);

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
 */

namespace Rudra\Container;

use Rudra\Exceptions\NotFoundException;

class Cookie
{
    public function get(string $id): mixed
    {
        if (!array_key_exists($id, $_COOKIE)) {
            throw new NotFoundException("Куки с идентификатором \"$id\" не найдено.");
        }
        return $_COOKIE[$id];
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $_COOKIE);
    }

    public function remove(string $id): void
    {
        if (!array_key_exists($id, $_COOKIE)) {
            throw new NotFoundException("Куки с идентификатором \"$id\" не найдено.");
        }
        $this->deleteCookie($id);
    }

    private function deleteCookie(string $id): void
    {
        unset($_COOKIE[$id]);
        setcookie($id, '', time() - 3600, '/');
    }

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

        // We use setcookie with a full set of parameters for security
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
