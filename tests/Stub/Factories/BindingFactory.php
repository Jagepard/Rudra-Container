<?php

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Container\Tests\Stub\Factories;

use Rudra\Container\Tests\Stub\BindingClass;
use Rudra\Container\Interfaces\FactoryInterface;

class BindingFactory implements FactoryInterface
{
    public function create(): object
    {
        return new BindingClass();
    }
}
