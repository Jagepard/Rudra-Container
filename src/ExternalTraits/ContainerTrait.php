<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra\ExternalTraits;

use Rudra\Pagination;
use Rudra\Interfaces\ContainerInterface;

/**
 * Trait ContainerTrait
 * @package Rudra\Container\Traits
 */
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
     * @param null $target
     * @return mixed
     */
    public function redirect($target = null)
    {
        return isset($target) ? $this->container()->get('redirect')->run($target) : $this->container()->get('redirect');
    }

    /**
     * @param null $key
     * @return mixed
     */
    public function post($key = null)
    {
        return $this->container()->getPost($key);
    }

    /**
     * @param      $object
     * @param null $params
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
    public function setPagination($value): void
    {
        $this->container()->set('pagination', new Pagination($value['id']), 'raw');
    }


    /**
     * @param string      $key
     * @param string      $value
     * @param string|null $subKey
     */
    public function setSession(string $key, string $value, string $subKey = null): void
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

    /**
     * @return mixed
     */
    abstract public function container(): ContainerInterface;
}
