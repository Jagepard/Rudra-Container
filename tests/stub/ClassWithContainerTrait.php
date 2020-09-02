<?php

namespace Rudra\Container\Tests\Stub;

use Rudra\Container\Traits\{ContainerTrait, SetContainerTrait};

class ClassWithContainerTrait
{
    use ContainerTrait;
    use SetContainerTrait;
}
