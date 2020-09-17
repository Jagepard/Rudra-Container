<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Traits;

use Rudra\Container\Application;

trait FacadeTrait
{
    public static string $name;

    public function __call($method, $parameters) {
        return $this->$method(...$parameters);
    }

    public static function __callStatic($method, $parameters)
    {
        $object = Application::run()->objects()->get(static::$name);
        return $object->$method(...$parameters);
    }
}
