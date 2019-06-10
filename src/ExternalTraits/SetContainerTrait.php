<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\ExternalTraits;

use Rudra\Interfaces\ContainerInterface;

trait SetContainerTrait
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * SetContainerTrait constructor.
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
