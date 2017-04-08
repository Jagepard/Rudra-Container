<?php

declare(strict_types = 1);

/**
 * Created by PhpStorm.
 * User: d
 * Date: 21.03.17
 * Time: 16:22
 */


use Rudra\ContainerTrait;
use Rudra\ContainerInterface;


/**
 * Class ClassWithContainerTrait
 */
class ClassWithContainerTrait
{

    use ContainerTrait;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * ClassWithContainerTrait constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return ContainerInterface
     */
    public function container(): ContainerInterface
    {
        return $this->container;
    }
}