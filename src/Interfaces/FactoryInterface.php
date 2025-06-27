<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

interface FactoryInterface
{
    /**
     * @return object
     */
    public function create(): object;
}
