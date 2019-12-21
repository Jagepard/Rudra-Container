<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Traits;

use Rudra\Pagination;

trait ContainerTrait
{
    /**
     * @return mixed
     */
    public function validation()
    {
        return rudra()->objects()->get('validation');
    }

    /**
     * @param $target
     * @return mixed
     */
    public function redirect($target = null)
    {
        return isset($target) ? rudra()->objects()->get('redirect')->run($target) : rudra()->objects()->get('redirect');
    }

    /**
     * @param $key
     * @return mixed
     */
    public function post($key = null)
    {
        return rudra()->request()->post()->get($key);
    }

    /**
     * @param      $object
     * @param      $params
     * @return mixed
     */
    public function new($object, $params = null)
    {
        return rudra()->objects()->new($object, $params);
    }

    /**
     * @param  string  $key
     * @param  string|null  $subKey
     */
    public function unsetSession(string $key, string $subKey = null)
    {
        rudra()->session()->unset($key, $subKey);
    }

    /**
     * @return mixed
     */
    public function pagination()
    {
        return rudra()->objects()->get('pagination');
    }

    /**
     * @param $page
     * @param $perPage
     * @param $numRows
     */
    public function setPagination($page, $perPage, $numRows): void
    {
        rudra()->objects()->set(['pagination', [new Pagination($page['id'], $perPage, $numRows), 'raw']]);
    }

    /**
     * @param  string  $key
     * @param  string  $value
     * @param  string|null  $subKey
     */
    public function setSession(string $key, string $value): void
    {
        rudra()->session()->set([$key, $value]);
    }

    /**
     * @return mixed
     */
    public function db()
    {
        return rudra()->objects()->get('db');
    }
}
