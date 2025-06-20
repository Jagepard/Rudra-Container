<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\{
    Container,
    Traits\InstantiationsTrait,
    Interfaces\RequestInterface,
};
use Psr\Container\ContainerInterface; 

class Request implements RequestInterface
{
    use InstantiationsTrait;

    public function get(): ContainerInterface
    {
        return $this->containerize("get", Container::class, $_GET);
    }

    public function post(): ContainerInterface
    {
        return $this->containerize("post", Container::class, $_POST);
    }

    public function put(): ContainerInterface
    {
        return $this->containerize("put", Container::class);
    }

    public function patch(): ContainerInterface
    {
        return $this->containerize("patch", Container::class);
    }

    public function delete(): ContainerInterface
    {
        return $this->containerize("delete", Container::class);
    }

    public function server(): ContainerInterface
    {
        return $this->containerize("server", Container::class, $_SERVER);
    }

    public function files(): ContainerInterface
    {
        return $this->containerize("files", Container::class, $_FILES);
    }
}