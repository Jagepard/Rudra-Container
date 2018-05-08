<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra\Container;

use Rudra\Container\Interfaces\ContainerConfigInterface;
use Rudra\Container\Interfaces\ContainerCookieInterface;
use Rudra\Container\Interfaces\ContainerGlobalInterface;
use Rudra\Container\Interfaces\ContainerInterface;
use Rudra\Container\Interfaces\ContainerReflectionInterface;
use Rudra\Container\Interfaces\ContainerResponseInterface;
use Rudra\Container\Interfaces\ContainerSessionInterface;
use Rudra\Container\Traits\ContainerConfigTrait;
use Rudra\Container\Traits\ContainerCookieTrait;
use Rudra\Container\Traits\ContainerGlobalsTrait;
use Rudra\Container\Traits\ContainerReflectionTrait;
use Rudra\Container\Traits\ContainerResponseTrait;
use Rudra\Container\Traits\ContainerSessionTrait;

/**
 * Class Container
 * @package Rudra
 */
class Container implements ContainerInterface, ContainerGlobalInterface,
                           ContainerCookieInterface, ContainerSessionInterface,
                           ContainerReflectionInterface, ContainerConfigInterface,
                           ContainerResponseInterface
{

    use ContainerGlobalsTrait;
    use ContainerCookieTrait;
    use ContainerSessionTrait;
    use ContainerReflectionTrait;
    use ContainerConfigTrait;
    use ContainerResponseTrait;

    /**
     * @var ContainerInterface
     */
    public static $app;

    /**
     * Container constructor.
     */
    protected function __construct()
    {
        $this->get    = $_GET;
        $this->post   = $_POST;
        $this->server = $_SERVER;
        $this->files  = $_FILES;
    }

    /**
     * @return ContainerInterface
     */
    public static function app(): ContainerInterface
    {
        if (!static::$app instanceof static) {
            static::$app = new static();
        }

        return static::$app;
    }

    /**
     * @param array $app
     */
    public function setServices(array $app): void
    {
        foreach ($app['contracts'] as $interface => $contract) {
            $this->setBinding($interface, $contract);
        }

        foreach ($app['services'] as $name => $service) {
            if (array_key_exists(1, $service)) {
                $this->set($name, $service[0], $service[1]);
                continue;
            }

            $this->set($name, $service[0]);
        }
    }
}
