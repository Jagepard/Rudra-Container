<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Traits;

use Rudra\Container\Abstracts\AbstractApplication;

trait SetRudraContainersTrait
{
    private AbstractApplication $rudra;

    public function __construct(AbstractApplication $rudra)
    {
        $this->rudra = $rudra;
    }

    public function rudra(): AbstractApplication
    {
        return $this->rudra;
    }
}
