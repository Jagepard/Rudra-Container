<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

use Rudra\Container\Files;
use Psr\Container\ContainerInterface; 

interface RequestInterface
{
    /**
     * @return ContainerInterface
     */
    public function get(): ContainerInterface;

    /**
     * @return ContainerInterface
     */
    public function post(): ContainerInterface;

    /**
     * @return ContainerInterface
     */
    public function put(): ContainerInterface;

    /**
     * @return ContainerInterface
     */
    public function patch(): ContainerInterface;

    /**
     * @return ContainerInterface
     */
    public function delete(): ContainerInterface;

    /**
     * @return ContainerInterface
     */
    public function server(): ContainerInterface;

    /**
     * @return ContainerInterface
     */
    public function files(): ContainerInterface;
}
