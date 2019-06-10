<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Interfaces;

interface ContainerResponseInterface
{
    /**
     * @codeCoverageIgnore
     * @param array $data
     */
    public function jsonResponse(array $data): void;
}
