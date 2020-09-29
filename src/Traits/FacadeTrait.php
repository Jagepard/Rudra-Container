<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Traits;

use Rudra\Container\Rudra;

trait FacadeTrait
{
//    public function __call($method, $parameters) {
//        return $this->$method(...$parameters);
//    }

    public static function __callStatic($method, $parameters)
    {
        if (!Rudra::_has(static::class)) {
            Rudra::_set([static::class, [static::class]]);
        }

        $object = Rudra::_get(static::class);

        return $object->$method(...$parameters);
    }
}
