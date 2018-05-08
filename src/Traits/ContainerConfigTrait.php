<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2017, Korotkov Danila
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
}
