<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Traits;

use Rudra\Container\Facades\Rudra;

trait FacadeTrait
{
    public static function __callStatic($method, $parameters = [])
    {
        $className = str_replace("Facade", "", static::class);
        if (!class_exists($className)) $className = str_replace("\s", "", $className);

        if (!Rudra::has($className)) {
            Rudra::set([$className, [$className]]);
        }

        return Rudra::get($className)->$method(...$parameters);
    }
}
