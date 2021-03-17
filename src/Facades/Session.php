<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Facades;

use Rudra\Container\Traits\FacadeTrait;

/**
 * @method static get(string $key = null)
 * @method static void set(array $data)
 * @method static bool has(string $key)
 * @method static void unset(string $key)
 * @method static void stop()
 * @method static void clear()
 * @method static void setFlash(string $type, array $data)
 *
 * @see \Rudra\Container\Session
 */
final class Session
{
    use FacadeTrait;
}
