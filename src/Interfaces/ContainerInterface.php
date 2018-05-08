<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra\Interfaces;

/**
 * Interface ContainerInterface
 * @package Rudra
 */
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

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key);

    /**
     * @param string $key
     * @param        $object
     * @param null   $params
     * @return mixed
     */
    public function set(string $key, $object, $params = null);

    /**
     * @param      $object
     * @param null $params
     * @return mixed
     */
    public function new($object, $params = null);

    /**
     * @param string $key
     *
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
     * @return mixed
     */
    public function hasParam(string $key, string $param);

    /**
     * @param string $key
     * @return mixed
     */
    public function getBinding(string $key);

    /**
     * @param string $key
     * @param        $value
     */
    public function setBinding(string $key, $value): void;
}
