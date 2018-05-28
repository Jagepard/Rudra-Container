<?php

namespace Rudra\Tests\Stub;

use Rudra\ExternalTraits\ContainerTrait;
use Rudra\ExternalTraits\SetContainerTrait;

class ClassWithContainerTrait
{

    use ContainerTrait;
    use SetContainerTrait;
}
