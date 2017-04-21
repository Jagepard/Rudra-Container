<?php

declare(strict_types = 1);

/**
 * Created by PhpStorm.
 * User: d
 * Date: 21.03.17
 * Time: 16:22
 */


use Rudra\ContainerTrait;
use Rudra\SetContainerTrait;


/**
 * Class ClassWithContainerTrait
 */
class ClassWithContainerTrait
{

    use SetContainerTrait;
    use ContainerTrait;
}