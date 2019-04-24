<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra\ExternalTraits;

use Rudra\Pagination;

trait ContainerTrait
{
    /**
     * @return mixed
     */
    public function validation()
    {
        return rudra()->get('validation');
    }

    /**
     * @param null $target
     * @return mixed
     */
    public function redirect($target = null)
    {
        return isset($target) ? rudra()->get('redirect')->run($target) : rudra()->get('redirect');
    }

    /**
     * @param null $key
     * @return mixed
     */
    public function post($key = null)
    {
        return rudra()->getPost($key);
    }

    /**
     * @param      $object
     * @param null $params
     * @return mixed
     */
    public function new($object, $params = null)
    {
        return rudra()->new($object, $params);
    }

    /**
     * @param string      $key
     * @param string|null $subKey
     */
    public function unsetSession(string $key, string $subKey = null)
    {
        rudra()->unsetSession($key, $subKey);
    }

    /**
     * @return mixed
     */
    public function pagination()
    {
        return rudra()->get('pagination');
    }

    /**
     * @param $page
     * @param $perPage
     * @param $numRows
     */
    public function setPagination($page, $perPage, $numRows): void
    {
        rudra()->set('pagination', new Pagination($page['id'], $perPage, $numRows), 'raw');
    }


    /**
     * @param string      $key
     * @param string      $value
     * @param string|null $subKey
     */
    public function setSession(string $key, string $value, string $subKey = null): void
    {
        rudra()->setSession($key, $value, $subKey);
    }

    /**
     * @return mixed
     */
    public function db()
    {
        return rudra()->get('db');
    }
}
