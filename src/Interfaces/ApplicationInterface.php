<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

interface ApplicationInterface
{
    // Config, Services and Binding
    public function config(): ContainerInterface;
    public function services(): ContainerInterface;
    public function binding(): ContainerInterface;
    public function setServices(array $services): void;

    // Containers for the HTTP / 1.1 Common Method Kit
    public function request(): RequestInterface;
    // For different types of responses
    public function response(): ResponseInterface;
    // Creates the main singleton
    public static function run(): ApplicationInterface;
}
