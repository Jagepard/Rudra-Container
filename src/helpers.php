<?php

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2019, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPL-3.0
 */

if (!function_exists('config')) {
    function config(string $key, string $subKey = null)
    {
        return \Rudra\Container::app()->config($key, $subKey);
    }
}

if (!function_exists('rudra')) {
    function rudra()
    {
        return \Rudra\Container::app();
    }
}
