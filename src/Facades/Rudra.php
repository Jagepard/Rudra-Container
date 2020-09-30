<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Facades;

final class Rudra
{
    public static function __callStatic($method, $parameters = [])
    {
        return \Rudra\Container\Rudra::run()->$method(...$parameters);
    }
}
