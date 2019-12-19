<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Interfaces\{ContainerInterface, RequestInterface};

class Request implements RequestInterface
{
    /**
     * @var array
     */
    private $instances = [];

    /**
     * @return ContainerInterface
     */
    public function get(): ContainerInterface
    {
        return $this->instantiate('get', Container::class, $_GET);
    }

    /**
     * @return ContainerInterface
     */
    public function post(): ContainerInterface
    {
        return $this->instantiate('post', Container::class, $_POST);
    }

    /**
     * @return ContainerInterface
     */
    public function put(): ContainerInterface
    {
        return $this->instantiate('put', Container::class);
    }

    /**
     * @return ContainerInterface
     */
    public function patch(): ContainerInterface
    {
        return $this->instantiate('patch', Container::class);
    }

    /**
     * @return ContainerInterface
     */
    public function delete(): ContainerInterface
    {
        return $this->instantiate('delete', Container::class);
    }

    /**
     * @return ContainerInterface
     */
    public function server(): ContainerInterface
    {
        return $this->instantiate('post', Container::class, $_SERVER);
    }

    /**
     * @return Files
     */
    public function files(): Files
    {
        return $this->instantiate('post', Files::class, $_FILES);
    }

    /**
     * @param $varName
     * @param $instance
     * @param $data
     * @return mixed
     */
    private function instantiate($varName, $instance, $data = [])
    {
        if (!array_key_exists($varName, $this->instances)) {
            $this->instances[$varName] = new $instance($data);
        }

        return $this->instances[$varName];
    }
}
