<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Interfaces\ResponseInterface;

class Response implements ResponseInterface
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
    public function json(array $data): void
    {
        header("Content-Type: application/json");
        print $this->getJson($data);
    }

    /**
     * Returns the JSON representation of a value
     * ------------------------------------------
     * Возвращает JSON-представление данных
     *
     * @param  array  $data
     * @return string
     */
    private function getJson(array $data): string
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
