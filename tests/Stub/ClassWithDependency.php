<?php

namespace Rudra\Container\Tests\Stub;

use Rudra\Container\Abstracts\AbstractApplication;

class ClassWithDependency
{
    public function __construct(AbstractApplication $container)
    {
    }
}
