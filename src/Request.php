<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\{
    Interfaces\ContainerInterface,
    Interfaces\RequestInterface,
    Request\Delete,
    Request\Files,
    Request\Get,
    Request\Patch,
    Request\Post,
    Request\Put,
    Request\Server
};

class Request implements RequestInterface
{
    /**
     * @var ContainerInterface
     */
    private $get;
    /**
     * @var ContainerInterface
     */
    private $post;
    /**
     * @var ContainerInterface
     */
    private $put;
    /**
     * @var ContainerInterface
     */
    private $patch;
    /**
     * @var ContainerInterface
     */
    private $delete;
    /**
     * @var ContainerInterface
     */
    private $server;
    /**
     * @var ContainerInterface
     */
    private $files;

    public function __construct()
    {
        $this->get = new Get($_GET);
        $this->post = new Post($_POST);
        $this->put = new Put();
        $this->patch = new Patch();
        $this->delete = new Delete();
        $this->server = new Server($_SERVER);
        $this->files = new Files($_FILES);
    }

    /**
     * @return ContainerInterface
     */
    public function get(): ContainerInterface
    {
        return $this->get;
    }

    /**
     * @return ContainerInterface
     */
    public function post(): ContainerInterface
    {
        return $this->post;
    }

    /**
     * @return ContainerInterface
     */
    public function put(): ContainerInterface
    {
        return $this->put;
    }

    /**
     * @return ContainerInterface
     */
    public function patch(): ContainerInterface
    {
        return $this->patch;
    }

    /**
     * @return ContainerInterface
     */
    public function delete(): ContainerInterface
    {
        return $this->delete;
    }

    /**
     * @return Server
     */
    public function server(): Server
    {
        return $this->server;
    }

    /**
     * @return Files
     */
    public function files(): Files
    {
        return $this->files;
    }
}
