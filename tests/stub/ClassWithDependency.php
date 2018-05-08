<?php

namespace Rudra\Container\Tests\Stub;

use Rudra\Container\Interfaces\ContainerInterface;

class ClassWithDependency
{

    public function __construct(ContainerInterface $container)
    {
    }
}
