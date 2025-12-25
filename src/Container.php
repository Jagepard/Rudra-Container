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

namespace Rudra\Container;

use Psr\Container\ContainerInterface;
use Rudra\Exceptions\NotFoundException;

class Container implements ContainerInterface
{
    /**
     * @param  array $data
     */
    public function __construct(protected array $data = []) {}

    /**
     * @param  string $id
     * @return mixed
     */
    public function get(string $id): mixed
    {
        return $this->has($id) 
            ? $this->data[$id] 
            : throw new NotFoundException("Identifier \"$id\" is not found.");
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->data;
    }

    /**
     * @param  array $data
     * @return void
     */
    public function set(array $data): void
    {
        $this->data = array_merge($this->data, $data);
    }

    /**
     * @param  string  $id
     * @return boolean
     */
    public function has(string $id): bool
    {
        return array_key_exists($id, $this->data);
    }
}
