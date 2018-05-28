<?php

namespace Rudra\Tests\Stub;

use Rudra\ContainerInterface;

class ClassWithDependency
{

    public function __construct(ContainerInterface $container)
    {
    }
}
