<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra\Traits;

/**
 * Trait ContainerConfigTrait
 * @package Rudra
 */
trait ContainerConfigTrait
{

    /**
     * @var array
     */
    protected $config = [];

    /**
     * @param string      $key
     * @param string|null $subKey
     * @return mixed
     */
    public function config(string $key, string $subKey = null)
    {
        return ($subKey === null) ? $this->config[$key] : $this->config[$key][$subKey];
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config): void
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param $key
     * @param $value
     */
    public function addConfig($key, $value): void
    {
        if (is_array($key) && array_key_exists(1, $key)) {
            $this->config[$key[0]][$key[1]] = $value;
            return;
        }

        $this->config[$key] = $value;
    }
}
