<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Traits;

use Rudra\Container\Interfaces\ApplicationInterface;

trait SetContainerTrait
{
    /**
     * @var ApplicationInterface
     */
    private $container;

    /**
     * SetContainerTrait constructor.
     * @param ApplicationInterface $container
     */
    public function __construct(ApplicationInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return ApplicationInterface
     */
    public function container(): ApplicationInterface
    {
        return $this->container;
    }
}
