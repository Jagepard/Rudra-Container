<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Traits;

trait ContainerResponseTrait // implements ContainerResponseInterface // PHP RFC: Traits with interfaces
{
    /**
     * @codeCoverageIgnore
     * @param array $data
     */
    public function jsonResponse(array $data): void
    {
        header('Content-Type: application/json');
        echo $this->getJson($data);
    }

    /**
     * @param array $data
     * @return string
     */
    private function getJson(array $data): string
    {
        return json_encode($data);
    }
}
