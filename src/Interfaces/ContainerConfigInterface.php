<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPL-3.0
 */

namespace Rudra\Interfaces;

/**
 * Interface ContainerConfigInterface
 * @package Rudra
 */
interface ContainerConfigInterface
{

    /**
     * @param string      $key
     * @param string|null $subKey
     * @return mixed
     */
    public function config(string $key, string $subKey = null);

    /**
     * @param array $config
     */
    public function setConfig(array $config): void;
}