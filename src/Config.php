<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

class Config extends AbstractContainer
{
    /**
     * @param $key
     * @param $value
     */
    public function add($key, $value): void
    {
        if (is_array($key) && array_key_exists(1, $key)) {
            $this->data[$key[0]][$key[1]] = $value;
            return;
        }

        $this->data[$key] = $value;
    }
}
