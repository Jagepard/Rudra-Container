<?php

use Rudra\Container\Facades\Rudra;

if (!function_exists('data')) {
    /**
     * Accesses the data container
     * ---------------------------
     * Получает доступ к контейнеру данных
     *
     * @param null $data
     * @return mixed|void
     */
    function data(string|array|null $data = null): mixed
    {
        if (is_array($data)) {
            Rudra::shared()->set($data);
            return;
        }
    
        return $data === null ? Rudra::shared()->all() : Rudra::shared()->get($data);
    }
}

if (!function_exists('config')) {
    /**
     * @param string|null $key
     * @param string|null $subKey
     * @return mixed
     */
    function config(?string $key, ?string $subKey = null): mixed
    {
        if (isset($key)) {
            if (isset($subKey)) {
                if (isset(Rudra::config()->get($key)[$subKey])) {
                    return Rudra::config()->get($key)[$subKey];
                }
            }

            return Rudra::config()->get($key);
        }

        return false;
    }
}
