<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Interfaces;

interface ContainerInterface
{
    /**
     * @return ContainerInterface
     */
    public static function app(): ContainerInterface;

    /**
     * @param $app
     */
    public function setServices(array $app): void;
}
