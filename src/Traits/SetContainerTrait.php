<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Traits;

use Rudra\Container\Interfaces\ApplicationInterface;

trait SetContainerTrait
{
    private ApplicationInterface $container;

    public function __construct(ApplicationInterface $container)
    {
        $this->container = $container;
    }

    public function container(): ApplicationInterface
    {
        return $this->container;
    }
}
