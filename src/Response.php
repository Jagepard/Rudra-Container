<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Abstracts\AbstractResponse;
use Rudra\Container\Traits\FacadeTrait;

class Response extends AbstractResponse
{
    use FacadeTrait;

    public static string $alias = "request";

    /**
     * @codeCoverageIgnore
     */
    protected function json(array $data): void
    {
        header("Content-Type: application/json");
        print $this->getJson($data);
    }

    private function getJson(array $data): string
    {
        return json_encode($data);
    }
}
