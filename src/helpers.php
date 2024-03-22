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
    function data($data = null)
    {
        if (is_array($data)) {
            Rudra::shared()->set($data);
            return;
        }

        if (empty($data)) {
            return Rudra::shared()->get();
        }

        return Rudra::shared()->get($data);
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
