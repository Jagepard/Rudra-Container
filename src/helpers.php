<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

if (!function_exists('config')) {
    function config()
    {
        return \Rudra\Container\Application::run()->config();
    }
}

if (!function_exists('rudra')) {
    function rudra()
    {
        return \Rudra\Container\Application::run();
    }
}

if (!function_exists('request')) {
    function request()
    {
        return \Rudra\Container\Application::run()->request();
    }
}

if (!function_exists('di')) {
    function di()
    {
        return \Rudra\Container\Application::run()->di();
    }
}
