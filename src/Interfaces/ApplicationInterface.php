<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

interface ApplicationInterface
{
    // Services and Binding
    public function binding(): ContainerInterface;
    public function setServices(array $services): void;

    // Containers for:
    public function objects(): ContainerInterface; // objects
    public function cookie(): ContainerInterface;
    public function session(): ContainerInterface;
    public function config(): ContainerInterface;

    // Containers for the HTTP / 1.1 Common Method Kit
    public function request(): RequestInterface;
    // For different types of responses
    public function response(): ResponseInterface;
    // Creates the main singleton
    public static function run(): ApplicationInterface;
}
