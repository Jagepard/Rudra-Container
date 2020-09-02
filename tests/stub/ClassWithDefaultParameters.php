<?php

namespace Rudra\Container\Tests\Stub;

class ClassWithDefaultParameters
{
    protected string $param;

    public function __construct(string $param = "Default")
    {
        $this->param = $param;
    }

    public function getParam(): string
    {
        return $this->param;
    }
}
