<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

interface ApplicationInterface
{
    /**
     * @return ApplicationInterface
     */
    public static function run(): ApplicationInterface;

    /**
     * @param $services
     */
    public function setServices(array $services): void;

    /**
     * @return ContainerInterface
     */
    public function objects(): ContainerInterface;

    /**
     * @return RequestInterface
     */
    public function request(): RequestInterface;

    /**
     * @return ContainerInterface
     */
    public function cookie(): ContainerInterface;

    /**
     * @return ContainerInterface
     */
    public function session(): ContainerInterface;

    /**
     * @return ResponseInterface
     */
    public function response(): ResponseInterface;

    /**
     * @return ContainerInterface
     */
    public function config(): ContainerInterface;

    /**
     * @return ContainerInterface
     */
    public function binding(): ContainerInterface;
}
