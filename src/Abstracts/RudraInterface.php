<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Abstracts;

use Rudra\Container\{Cookie, Session};

interface RudraInterface
{
    // Config, Services and Binding
    public function config(): ContainerInterface;
    public function services(): ContainerInterface;
    public function binding(): ContainerInterface;
    public function setServices(array $services): void;

    // Containers for the HTTP / 1.1 Common Method Kit
    public function request(): AbstractRequest;
    // For different types of responses
    public function response(): AbstractResponse;
    // Creates the main singleton
    public static function run(): AbstractRudra;

    public function cookie(): Cookie;
    public function session(): Session;
}
