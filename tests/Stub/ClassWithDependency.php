<?php

namespace Rudra\Container\Tests\Stub;

use Rudra\Container\Interfaces\ApplicationInterface;

class ClassWithDependency
{
    public function __construct(ApplicationInterface $container)
    {
    }
}
