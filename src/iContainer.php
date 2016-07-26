<?php
/**
 * Date: 15.03.16
 * Time: 20:35
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2016, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra;

/**
 * Interface iContainer
 * @package Rudra
 */
interface iContainer
{
    /**
     * @param $key
     * @return mixed
     */
    public function get($key);

    /**
     * @param $key
     * @param $object
     * @return void
     */
    public function set($key, $object);

    /**
     * @param $key
     * @return bool
     */
    public function is($key);

    /**
     * @param $key
     * @param $param
     * @return mixed
     */
    public function getParam($key, $param);
}