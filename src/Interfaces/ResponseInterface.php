<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

interface ResponseInterface
{
    /**
     * @codeCoverageIgnore
     * @param array $data
     */
    public function json(array $data): void;
}
