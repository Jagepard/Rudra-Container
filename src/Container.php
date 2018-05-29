<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra;

use Rudra\Traits\ContainerConfigTrait;
use Rudra\Traits\ContainerCookieTrait;
use Rudra\Traits\ContainerGlobalsTrait;
use Rudra\Traits\ContainerSessionTrait;
use Rudra\Traits\ContainerResponseTrait;
use Rudra\Traits\ContainerReflectionTrait;
use Rudra\Interfaces\ContainerInterface;

/**
 * Class Container
 * @package Rudra
 */
class Container implements ContainerInterface
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
