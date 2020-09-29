<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Abstracts;

use Rudra\Container\{Cookie, Session};

abstract class AbstractRudra
{
    // Config, Services and Binding
    abstract protected function _config(): ContainerInterface;
    abstract protected function _services(): ContainerInterface;
    abstract protected function _binding(): ContainerInterface;
    abstract protected function _setServices(array $services): void;

    // Containers for the HTTP / 1.1 Common Method Kit
    abstract protected function _request(): AbstractRequest;
    // For different types of responses
    abstract protected function _response(): AbstractResponse;
    // Creates the main singleton
    abstract public static function run(): AbstractRudra;

    abstract protected function _cookie(): Cookie;
    abstract protected function _session(): Session;

    // Protected container
    abstract protected function _get(string $key = null);
    abstract protected function _set(array $data): void;
    abstract protected function _has(string $key): bool;
}
