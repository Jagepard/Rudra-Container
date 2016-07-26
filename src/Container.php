<?php

namespace Rudra;

    /**
     * Date: 25.08.2016
     * Time: 14:50
     * @author    : Korotkov Danila <dankorot@gmail.com>
     * @copyright Copyright (c) 2016, Korotkov Danila
     * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
     */

/**
 * Class Application
 * @package Core
 */
class Container implements iContainer
{
    /**
     * @var array
     */
    protected $objects = [];

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->objects[$key];
    }

    /**
     * @param $key
     * @param $object
     */
    public function set($key, $object)
    {
        $this->objects[$key] = $object;
    }

    /**
     * @param $key
     * @param $param
     * @param $value
     */
    public function setParam($key, $param, $value)
    {
        if (isset($this->objects[$key])){
            $this->get($key)->$param = $value;
        }
    }

    /**
     * @param $key
     * @return bool
     */
    public function is($key)
    {
        return isset($this->objects[$key]) ? true : false;
    }

    /**
     * @param $key
     * @param $param
     * @return mixed
     */
    public function getParam($key, $param)
    {
        if ($this->is($key)){
            if (isset($this->get($key)->$param)){
                return $this->get($key)->$param;
            }
        }
    }
}
