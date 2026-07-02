<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
 */

namespace Rudra\Container\Interfaces;

use Psr\Container\ContainerInterface; 

interface RequestInterface
{
    public function get(): ContainerInterface;
    public function post(): ContainerInterface;
    public function put(): ContainerInterface;
    public function patch(): ContainerInterface;
    public function delete(): ContainerInterface;
    public function server(): ContainerInterface;
    public function files(): ContainerInterface;
}
