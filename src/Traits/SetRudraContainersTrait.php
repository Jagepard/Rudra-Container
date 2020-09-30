<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Traits;

use Rudra\Container\Interfaces\RequestInterface;

trait SetRudraContainersTrait
{
    private RequestInterface $rudra;

    public function __construct(RequestInterface $rudra)
    {
        $this->rudra = $rudra;
    }

    public function rudra(): RequestInterface
    {
        return $this->rudra;
    }
}
