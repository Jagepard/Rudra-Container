<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

use Rudra\Container\{Cookie, Session};

interface RudraInterface
{
    // Config, Services and Binding
    public function config(array $config = []): ContainerInterface;
    public function services(array $services = []): ContainerInterface;
    public function binding(array $contracts = []): ContainerInterface;

    // Containers for the HTTP / 1.1 Common Method Kit
    public function request(): RequestInterface;
    // For different types of responses
    public function response(): ResponseInterface;
    // Creates the main singleton
    public static function run(): RudraInterface;

    public function cookie(): Cookie;
    public function session(): Session;
}
