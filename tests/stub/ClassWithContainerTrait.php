<?php

namespace Rudra\Tests\Stub;

use Rudra\Traits\ContainerTrait;
use Rudra\ExternalTraits\SetContainerTrait;

class ClassWithContainerTrait
{

    use ContainerTrait;
    use SetContainerTrait;
}
