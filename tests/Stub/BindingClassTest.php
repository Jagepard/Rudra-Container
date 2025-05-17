<?php

namespace Rudra\Container\Tests\Stub;

use Rudra\Container\Tests\Stub\Interfaces\BindInterface;

class BindingClassTest
{
    protected BindInterface $bind;
    protected string $param;

    public function __construct(BindInterface $bind, string $param = "Default")
    {
        $this->bind = $bind;
        $this->param = $param;
    }

    public function getParam(): string
    {
        return $this->param;
    }

    public function getBind(): BindInterface
    {
        return $this->bind;
    }
}