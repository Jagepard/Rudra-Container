<?php

use \Rudra\IContainer;


/**
 * Class ClassWithDependency
 */
class ClassWithDependency
{

    /**
     * ClassWithDependency constructor.
     *
     * @param IContainer $container
     */
    public function __construct(IContainer $container)
    {
    }
}