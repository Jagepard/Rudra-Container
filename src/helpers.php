<?php

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

use Rudra\Container\Facades\Rudra;

if (!function_exists('data')) {
    function data(mixed $data = null): mixed
    {
        return is_array($data)
            ? Rudra::shared()->set($data)
            : ($data === null
                ? Rudra::shared()->all()
                : Rudra::shared()->get($data));
    }
}

if (!function_exists('config')) {
    function config(?string $key, ?string $subKey = null): mixed
    {
        if ($key === null) {
            return Rudra::config()->all();
        }
    
        $data = Rudra::config()->get($key);
    
        if ($subKey === null) {
            return $data;
        }
    
        return is_array($data) && isset($data[$subKey]) ? $data[$subKey] : false;
    }
}
