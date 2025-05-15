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

    /**
     * Creates a container for HTTP GET variables
     * ------------------------------------------
     * Создает контейнер для переменных HTTP GET
     *
     * @return ContainerInterface
     */
    public function get(): ContainerInterface
    {
        return $this->containerize("get", Container::class, $_GET);
    }

    /**
     * Creates a container for HTTP POST variables
     * ------------------------------------------
     * Создает контейнер для переменных HTTP POST
     *
     * @return ContainerInterface
     */
    public function post(): ContainerInterface
    {
        return $this->containerize("post", Container::class, $_POST);
    }

    /**
     * Creates a container for HTTP PUT variables
     * ------------------------------------------
     * Создает контейнер для переменных HTTP PUT
     *
     * @return ContainerInterface
     */
    public function put(): ContainerInterface
    {
        return $this->containerize("put", Container::class);
    }

    /**
     * Creates a container for HTTP PATCH variables
     * ------------------------------------------
     * Создает контейнер для переменных HTTP PATCH
     *
     * @return ContainerInterface
     */
    public function patch(): ContainerInterface
    {
        return $this->containerize("patch", Container::class);
    }

    /**
     * Creates a container for HTTP DELETE variables
     * ------------------------------------------
     * Создает контейнер для переменных HTTP DELETE
     *
     * @return ContainerInterface
     */
    public function delete(): ContainerInterface
    {
        return $this->containerize("delete", Container::class);
    }

    /**
     * Creates a container for server and execution environment information
     * --------------------------------------------------------------------
     * Создает контейнер для информации о сервере и среде исполнения
     *
     * @return ContainerInterface
     */
    public function server(): ContainerInterface
    {
        return $this->containerize("server", Container::class, $_SERVER);
    }

    /**
     * Creates a container for HTTP File Upload variables
     * --------------------------------------------------
     * Создает контейнер для переменных файлов, загруженных по HTTP
     *
     * @return ContainerInterface
     */
    public function files(): ContainerInterface
    {
        return $this->containerize("files", Container::class, $_FILES);
    }
}
