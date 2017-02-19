<?php

use PHPUnit\Framework\TestCase;
use \Rudra\IContainer;


class ClassWithDependency
{
    public function __construct(IContainer $container)
    {
    }
}