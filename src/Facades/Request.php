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

namespace Rudra\Container\Facades;

use Rudra\Container\{Traits\FacadeTrait, Interfaces\ContainerInterface};

/**
 * @method static ContainerInterface get()
 * @method static ContainerInterface post()
 * @method static ContainerInterface put()
 * @method static ContainerInterface patch()
 * @method static ContainerInterface delete()
 * @method static ContainerInterface server()
 * @method static ContainerInterface files()
 *
 * @see \Rudra\Container\Request
 */
final class Request
{
    use FacadeTrait;
}
