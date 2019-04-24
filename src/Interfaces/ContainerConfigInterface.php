<?php

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2019, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra\Interfaces;

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

    /**
     * @return array
     */
    public function getConfig(): array;

    /**
     * @param $key
     * @param $value
     */
    public function addConfig($key, $value): void;
}
