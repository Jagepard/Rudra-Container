<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Abstracts;

use Rudra\Container\Files;

abstract class AbstractRequest
{
    abstract protected function get(): AbstractContainer;
    abstract protected function post(): AbstractContainer;
    abstract protected function put(): AbstractContainer;
    abstract protected function patch(): AbstractContainer;
    abstract protected function delete(): AbstractContainer;
    abstract protected function server(): AbstractContainer;
    abstract protected function files(): Files;
}
