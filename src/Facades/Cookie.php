<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Container\Facades;

use Rudra\Container\Traits\FacadeTrait;

/**
 * @method static mixed get(string $id)
 * @method static bool has(string $id)
 * @method static void unset(string $id)
 * @method static void set(array $data)
 *
 * @see \Rudra\Container\Cookie
 */
final class Cookie
{
    use FacadeTrait;
}
