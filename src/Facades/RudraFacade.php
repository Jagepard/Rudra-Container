<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Facades;

use Rudra\Container\Rudra;

final class RudraFacade
{
    public static function __callStatic($method, $parameters = [])
    {
        return Rudra::run()->$method(...$parameters);
    }
}
