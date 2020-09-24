<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\{
    Abstracts\ContainerInterface,
    Abstracts\AbstractRequest,
    Traits\FacadeTrait,
    Traits\InstantiationsTrait
};

class Request extends AbstractRequest
{
    use FacadeTrait;
    use InstantiationsTrait;

    protected function get(): ContainerInterface
    {
        return $this->instantiate("get", Container::class, $_GET);
    }

    protected function post(): ContainerInterface
    {
        return $this->instantiate("post", Container::class, $_POST);
    }

    protected function put(): ContainerInterface
    {
        return $this->instantiate("put", Container::class);
    }

    protected function patch(): ContainerInterface
    {
        return $this->instantiate("patch", Container::class);
    }

    protected function delete(): ContainerInterface
    {
        return $this->instantiate("delete", Container::class);
    }

    protected function server(): ContainerInterface
    {
        return $this->instantiate("server", Container::class, $_SERVER);
    }

    protected function files(): Files
    {
        return $this->instantiate("files", Files::class, $_FILES);
    }
}
