<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Abstracts;

use Rudra\Container\Files;

abstract class AbstractRequest
{
    abstract protected function get(): ContainerInterface;
    abstract protected function post(): ContainerInterface;
    abstract protected function put(): ContainerInterface;
    abstract protected function patch(): ContainerInterface;
    abstract protected function delete(): ContainerInterface;
    abstract protected function server(): ContainerInterface;
    abstract protected function files(): Files;
}
