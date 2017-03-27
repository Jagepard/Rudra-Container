<?php

declare(strict_types = 1);

/**
 * Created by PhpStorm.
 * User: d
 * Date: 21.03.17
 * Time: 16:22
 */


use Rudra\ContainerTrait;
use Rudra\IContainer;


/**
 * Class ClassWithContainerTrait
 */
class ClassWithContainerTrait
{

    use ContainerTrait;

    /**
     * @var IContainer
     */
    protected $container;

    /**
     * ClassWithContainerTrait constructor.
     *
     * @param IContainer $container
     */
    public function __construct(IContainer $container)
    {
        $this->container = $container;
    }

    /**
     * @return IContainer
     */
    public function container(): IContainer
    {
        return $this->container;
    }
}