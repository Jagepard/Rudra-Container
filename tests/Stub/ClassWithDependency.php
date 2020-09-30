<?php

namespace Rudra\Container\Tests\Stub;

use Rudra\Container\Interfaces\RudraInterface;

class ClassWithDependency
{
    public function __construct(RudraInterface $container)
    {
    }
}
