<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPL-3.0
 */

namespace Rudra\Container\Interfaces;

/**
 * Interface ContainerReflectionInterface
 * @package Rudra
 */
interface ContainerReflectionInterface
{

    /**
     * @param      $object
     * @param null $params
     * @return mixed|object
     */
    public function new($object, $params = null);

    /**
     * @param string|null $key
     * @return array|mixed
     */
    public function get(string $key = null);

    /**
     * @param string $key
     * @param        $object
     * @param null   $params
     * @return object|void
     */
    public function set(string $key, $object, $params = null);

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * @param string $key
     * @param string $param
     * @return mixed
     */
    public function getParam(string $key, string $param);
    /**
     * @param string $key
     * @param string $param
     * @param        $value
     */
    public function setParam(string $key, string $param, $value): void;

    /**
     * @param string $key
     * @param string $param
     * @return bool
     */
    public function hasParam(string $key, string $param);

    /**
     * @param string $key
     * @return mixed|string
     */
    public function getBinding(string $key);

    /**
     * @param string $key
     * @param        $value
     */
    public function setBinding(string $key, $value): void;
}