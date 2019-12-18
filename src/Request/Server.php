<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Request;

use Rudra\Container\AbstractContainer;

class Server extends AbstractContainer
{
    /**
     * @param  string|null  $key
     * @return array|null
     */
    public function get(string $key = null)
    {
        if (isset($key)) {
            return $this->data[$key] ?? null;
        }

        return $this->data;
    }

    /**
     * @param  string  $key
     * @param  string  $value
     */
    public function setValue(string $key, string $value)
    {
        $this->data[$key] = $value;
    }
}
