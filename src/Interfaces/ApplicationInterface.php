<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

use Rudra\Container\Request;

interface ApplicationInterface
{
    /**
     * @return ApplicationInterface
     */
    public static function app(): ApplicationInterface;

    /**
     * @param $app
     */
    public function setServices(array $app): void;

    /**
     * @return Request
     */
    public function request(): Request;

    /**
     * @return CookieInterface
     */
    public function cookie(): CookieInterface;

    /**
     * @return SessionInterface
     */
    public function session(): SessionInterface;

    /**
     * @return ResponseInterface
     */
    public function response(): ResponseInterface;

    /**
     * @return ContainerInterface
     */
    public function config(): ContainerInterface;
}
