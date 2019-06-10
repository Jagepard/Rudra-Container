<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
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
