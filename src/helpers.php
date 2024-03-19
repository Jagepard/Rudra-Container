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
            Rudra::data()->set($data);
            return;
        }

        if (empty($data)) {
            return Rudra::data()->get();
        }

        return Rudra::data()->get($data);
    }
}

if (!function_exists('config')) {
    /**
     * @param string|null $key
     * @param string|null $subKey
     * @return mixed
     */
    function config(?string $key, ?string $subKey): mixed
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
