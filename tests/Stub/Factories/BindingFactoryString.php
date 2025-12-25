<?php

namespace Rudra\Container\Tests\Stub\Factories;

use Rudra\Container\Tests\Stub\BindingClass;

class BindingFactoryString
{
    public function create()
    {
        return new BindingClass();
    }
}
