<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Facades;

use Rudra\Container\{Files, Traits\FacadeTrait, Interfaces\ContainerInterface};

/**
 * @method static ContainerInterface get()
 * @method static ContainerInterface post()
 * @method static ContainerInterface put()
 * @method static ContainerInterface patch()
 * @method static ContainerInterface delete()
 * @method static ContainerInterface server()
 * @method static Files files()
 *
 * @see \Rudra\Container\Request
 */
final class Request
{
    use FacadeTrait;
}
