<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Traits;

use Rudra\Container\Abstracts\AbstractRudra;

trait SetRudraContainersTrait
{
    private AbstractRudra $rudra;

    public function __construct(AbstractRudra $rudra)
    {
        $this->rudra = $rudra;
    }

    public function rudra(): AbstractRudra
    {
        return $this->rudra;
    }
}
