<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Traits;

use Rudra\Container\Interfaces\RudraInterface;

trait SetRudraContainersTrait
{
    private RudraInterface $rudra;

    public function __construct(RudraInterface $rudra)
    {
        $this->rudra = $rudra;
    }

    public function rudra(): RudraInterface
    {
        return $this->rudra;
    }
}
