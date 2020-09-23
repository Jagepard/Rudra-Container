<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Abstracts;

abstract class AbstractResponse
{
    /**
     * @codeCoverageIgnore
     */
    abstract protected function json(array $data): void;
}
