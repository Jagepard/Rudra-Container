<?php

/**
 * Date: 21.03.2017
 * Time: 18:26
 *
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2016, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra;


trait ContainerTrait
{

    /**
     * @return mixed
     */
    public function validation()
    {
        return $this->container()->get('validation');
    }

    /**
     * @return mixed
     */
    public function redirect()
    {
        return $this->container()->get('redirect');
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function post($key)
    {
        return $this->container()->getPost($key);
    }

    /**
     * @param      $object
     * @param null $params
     *
     * @return mixed
     */
    public function new($object, $params = null)
    {
        return $this->container()->new($object, $params);
    }

    /**
     * @param string      $key
     * @param string|null $subKey
     */
    public function unsetSession(string $key, string $subKey = null)
    {
        $this->container()->unsetSession($key, $subKey);
    }

    /**
     * @return mixed
     */
    public function pagination()
    {
        return $this->container()->get('pagination');
    }

    /**
     * @param $value
     */
    public function setPagination($value)
    {
        $this->container()->set('pagination', new Pagination($value['id']), 'raw');
    }


    /**
     * @param string      $key
     * @param string      $value
     * @param string|null $subKey
     */
    public function setSession(string $key, string $value, string $subKey = null)
    {
        $this->container()->setSession($key, $value, $subKey);
    }

    /**
     * @return mixed
     */
    public function db()
    {
        return $this->container()->get('db');
    }
}