<?php

namespace Rudra\Container\Tests\Stub;

use stdClass;

class ClassWithDefaultParameters
{
    protected string $param;
    protected stdClass $std;

    public function __construct(stdClass $std, string $param = "Default")
    {
        $this->param = $param;
        $this->std   = $std;
    }

    public function getParam(): string
    {
        return $this->param;
    }

    public function getStd(): stdClass
    {
        return $this->std;
    }
}
