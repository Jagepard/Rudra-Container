<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\{
    Abstracts\AbstractContainer,
    Abstracts\AbstractRequest,
    Traits\FacadeTrait,
    Traits\InstantiationsTrait
};

class Request extends AbstractRequest
{
    use FacadeTrait;
    use InstantiationsTrait;

    public static string $alias = "request";

    protected function get(): AbstractContainer
    {
        return $this->instantiate("get", Container::class, $_GET);
    }

    protected function post(): AbstractContainer
    {
        return $this->instantiate("post", Container::class, $_POST);
    }

    protected function put(): AbstractContainer
    {
        return $this->instantiate("put", Container::class);
    }

    protected function patch(): AbstractContainer
    {
        return $this->instantiate("patch", Container::class);
    }

    protected function delete(): AbstractContainer
    {
        return $this->instantiate("delete", Container::class);
    }

    protected function server(): AbstractContainer
    {
        return $this->instantiate("server", Container::class, $_SERVER);
    }

    protected function files(): Files
    {
        return $this->instantiate("files", Files::class, $_FILES);
    }
}
