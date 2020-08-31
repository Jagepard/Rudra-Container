<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

interface ResponseInterface
{
    /**
     * @codeCoverageIgnore
     */
    public function json(array $data): void;
}
