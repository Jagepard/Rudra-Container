<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

interface ApplicationInterface
{
    public static function run(): ApplicationInterface;
    public function setServices(array $services): void;
    public function di(): ContainerInterface;
    public function request(): RequestInterface;
    public function cookie(): ContainerInterface;
    public function session(): ContainerInterface;
    public function response(): ResponseInterface;
    public function config(): ContainerInterface;
    public function binding(): ContainerInterface;
}
