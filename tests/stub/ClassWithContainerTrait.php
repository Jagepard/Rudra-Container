<?php

namespace Rudra\Container\Tests\Stub;

use Rudra\Container\Traits\ContainerTrait;
use Rudra\Container\Traits\SetContainerTrait;

class ClassWithContainerTrait
{

    use ContainerTrait;
    use SetContainerTrait;
}
