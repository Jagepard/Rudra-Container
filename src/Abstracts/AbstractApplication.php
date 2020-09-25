<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Abstracts;

use Rudra\Container\{Cookie, Session};

abstract class AbstractApplication
{
    // Config, Services and Binding
    abstract protected function config(): ContainerInterface;
    abstract protected function services(): ContainerInterface;
    abstract protected function binding(): ContainerInterface;
    abstract protected function setServices(array $services): void;

    // Containers for the HTTP / 1.1 Common Method Kit
    abstract protected function request(): AbstractRequest;
    // For different types of responses
    abstract protected function response(): AbstractResponse;
    // Creates the main singleton
    abstract public static function run(): AbstractApplication;

    abstract protected function cookie(): Cookie;
    abstract protected function session(): Session;

    // Protected container
    abstract protected function get(string $key = null);
    abstract protected function set(array $data): void;
    abstract protected function has(string $key): bool;
}
