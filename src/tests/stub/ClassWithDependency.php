<?php

use \Rudra\ContainerInterface;


/**
 * Class ClassWithDependency
 */
class ClassWithDependency
{

    /**
     * ClassWithDependency constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
    }
}