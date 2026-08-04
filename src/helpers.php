<?php declare(strict_types=1);

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
use Rudra\Exceptions\NotFoundException;

if (!function_exists('data')) {
    function data(array|string|null $key = null): mixed
    {
        $shared = Rudra::shared();

        if (is_array($key)) {
            $shared->set($key);
            return $shared->all();
        }

        if ($key === null) {
            return $shared->all();
        }

        $data = $shared->all();

        foreach (explode('.', $key) as $segment) {
            if (!is_array($data) || !array_key_exists($segment, $data)) {
                throw new NotFoundException("Data key \"$key\" not found.");
            }

            $data = $data[$segment];
        }

        return $data;
    }
}

if (!function_exists('config')) {
    function config(?string $key): mixed
    {
        if ($key === null) {
            return Rudra::config()->all();
        }

        $data = Rudra::config()->all();

        foreach (explode('.', $key) as $segment) {
            if (!is_array($data) || !array_key_exists($segment, $data)) {
                throw new NotFoundException("Configuration key \"$key\" not found.");
            }
            $data = $data[$segment];
        }

        return $data;
    }
}

if (!function_exists('json')) {
    function json(array $data): void
    {
        Response::json($data);
    }
}
