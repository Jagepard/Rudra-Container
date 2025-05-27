<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

use Rudra\Container\Files;
use Psr\Container\ContainerInterface; 

interface RequestInterface
{
    public function get(): ContainerInterface;
    public function post(): ContainerInterface;
    public function put(): ContainerInterface;
    public function patch(): ContainerInterface;
    public function delete(): ContainerInterface;
    public function server(): ContainerInterface;
    public function files(): ContainerInterface;
}
