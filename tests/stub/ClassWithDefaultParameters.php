<?php

namespace Rudra\Tests\Stub;

class ClassWithDefaultParameters
{

    protected $param;

    public function __construct(string $param = 'Default')
    {
        $this->param = $param;
    }

    /**
     * @return string
     */
    public function getParam(): string
    {
        return $this->param;
    }
}
