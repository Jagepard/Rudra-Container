<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

if (!function_exists('config')) {
    function config(string $key)
    {
        return \Rudra\Container\Application::app()->config()->get($key);
    }
}

if (!function_exists('rudra')) {
    function rudra()
    {
        return \Rudra\Container\Application::run();
    }
}
