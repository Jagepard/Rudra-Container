<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Traits;

use Rudra\Container\Facades\RudraFacade;
use Rudra\Container\Rudra;

trait FacadeTrait
{
    public static function __callStatic($method, $parameters = [])
    {
        $className = str_replace("Facade", "", static::class);
        if (!class_exists($className)) $className = str_replace("\s", "", $className);

        if (!RudraFacade::has($className)) {
            RudraFacade::set([$className, [$className]]);
        }

        return Rudra::run()->get($className)->$method(...$parameters);
    }
}
