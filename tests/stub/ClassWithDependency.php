<?php

namespace Rudra\Tests\Stub;

use Rudra\Interfaces\ContainerInterface;

class ClassWithDependency
{

    public function __construct(ContainerInterface $container)
    {
    }
}
