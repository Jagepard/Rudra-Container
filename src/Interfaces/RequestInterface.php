<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

use Rudra\Container\Request\Files;
use Rudra\Container\Request\Server;

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
     * @return Server
     */
    public function server(): Server;

    /**
     * @return Files
     */
    public function files(): Files;
}