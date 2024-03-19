<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Facades;

use Rudra\Container\Traits\FacadeTrait;

/**
 * @method static bool has(string $key)
 * @method static void set(array $data)
 * @method static void unset(string $key)
 * @method static mixed get(string $key = null)
 *
 * @see \Rudra\Container\Cookie
 */
final class Cookie
{
    use FacadeTrait;
}
