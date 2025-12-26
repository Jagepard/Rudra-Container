<?php

declare(strict_types=1);

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
 */

use Rudra\Container\Facades\Rudra;
use Rudra\Container\Facades\Response;

if (!function_exists('data')) {
    function data(mixed $data = null): mixed
    {
        if (is_array($data)) {
            Rudra::shared()->set($data);
            return Rudra::shared()->all();
        }

        if ($data === null) {
            return Rudra::shared()->all();
        }

        return Rudra::shared()->get($data);
    }
}

if (!function_exists('config')) {
    function config(?string $key, ?string $subKey = null): mixed
    {
        if ($key === null) {
            return Rudra::config()->all();
        }

        $data = Rudra::config()->get($key);

        if ($subKey === null) {
            return $data;
        }

        return is_array($data) && isset($data[$subKey]) ? $data[$subKey] : false;
    }
}

if (!function_exists('json')) {
    function json(array $data): void
    {
        Response::json($data);
    }
}

