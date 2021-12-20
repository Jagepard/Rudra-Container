<?php

use Rudra\Container\Facades\Rudra;

if (!function_exists('data')) {
    /**
     * @param  $data
     * @return string
     */
    function data($data = null): string
    {
        if (is_array($data)) {
            Rudra::data()->set($data);
            return;
        }

        if (empty($data)) {
            return Rudra::data()->get();
        }

        return Rudra::data()->get();
    }
}