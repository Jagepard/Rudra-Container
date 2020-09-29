<?php

namespace Rudra\Container\Tests\Stub;

use Rudra\Container\Abstracts\RudraInterface;

class ClassWithDependency
{
    public function __construct(RudraInterface $container)
    {
    }
}
