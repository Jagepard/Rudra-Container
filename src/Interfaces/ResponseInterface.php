<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

interface ResponseInterface
{
    /**
     * Displays data in JSON format
     * ----------------------------
     * Отображает данные в формате JSON.
     *
     * @param  array $data
     * @return void
     * 
     * @codeCoverageIgnore
     */
    public function json(array $data): void;
}
