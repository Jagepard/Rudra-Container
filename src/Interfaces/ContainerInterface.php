<?php

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
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
