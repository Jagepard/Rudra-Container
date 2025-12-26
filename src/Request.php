<?php declare(strict_types=1);

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
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
     * @return ContainerInterface
     */
    public function get(): ContainerInterface
    {
        return $this->containerize("get", Container::class, $_GET);
    }

    /**
     * @return ContainerInterface
     */
    public function post(): ContainerInterface
    {
        return $this->containerize("post", Container::class, $_POST);
    }

    /**
     * @return ContainerInterface
     */
    public function put(): ContainerInterface
    {
        return $this->containerize("put", Container::class);
    }

    /** 
     * @return ContainerInterface
     */
    public function patch(): ContainerInterface
    {
        return $this->containerize("patch", Container::class);
    }

    /**
     * @return ContainerInterface
     */
    public function delete(): ContainerInterface
    {
        return $this->containerize("delete", Container::class);
    }

    /**
     * @return ContainerInterface
     */
    public function server(): ContainerInterface
    {
        return $this->containerize("server", Container::class, $_SERVER);
    }

    /**
     * @return ContainerInterface
     */
    public function files(): ContainerInterface
    {
        return $this->containerize("files", Container::class, $_FILES);
    }
}