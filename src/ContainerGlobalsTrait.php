<?php

declare(strict_types = 1);

/**
 * Date: 06.04.17
 * Time: 15:00
 *
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2016, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra;

/**
 * Class ContainerFilesTrait
 *
 * @package Rudra
 */
trait ContainerGlobalsTrait
{

    /**
     * @var array
     */
    protected $get;

    /**
     * @var array
     */
    protected $post;

    /**
     * @var array
     */
    protected $server;

    /**
     * @var array
     */
    protected $files;

    /**
     * Container constructor.
     */
    protected function __construct()
    {
        $this->get    = $_GET;
        $this->post   = $_POST;
        $this->server = $_SERVER;
        $this->files  = $_FILES;
    }

    /**
     * @param string|null $key
     *
     * @return array|mixed
     */
    public function getGet(string $key = null)
    {
        return empty($key) ? $this->get : $this->get[$key];
    }

    /**
     * @param array $get
     */
    public function setGet(array $get): void
    {
        $this->get = $get;
    }


    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasGet(string $key): bool
    {
        return isset($this->get[$key]);
    }

    /**
     * @param string|null $key
     *
     * @return array|mixed
     */
    public function getPost(string $key = null)
    {
        return empty($key) ? $this->post : $this->post[$key];
    }

    /**
     * @param array $post
     */
    public function setPost(array $post): void
    {
        $this->post = $post;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasPost(string $key): bool
    {
        return isset($this->post[$key]);
    }

    /**
     * @param string $key
     *
     * @return array|mixed|null
     */
    public function getServer(string $key = null)
    {
        if (isset($key)) {
            return $this->server[$key] ?? null;
        }

        return $this->server;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setServer(string $key, string $value)
    {
        $this->server[$key] = $value;
    }

    /**
     * @param array $files
     */
    public function setFiles(array $files)
    {
        $this->files = $files;
    }

    /**
     * @param string $key
     * @param string $fieldName
     * @param string $formName
     *
     * @return string
     */
    public function getUpload(string $key, string $fieldName, string $formName = 'upload') : string
    {
        return $this->files[$formName][$fieldName][$key];
    }

    /**
     * @param string $value
     * @param string $formName
     *
     * @return bool
     */
    public function isUploaded(string $value, string $formName = 'upload') : bool
    {
        return ($this->files[$formName]['name'][$value] !== '');
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return bool
     */
    public function isFileType(string $key, string $value) : bool
    {
        return ($this->files['type'][$key] == $value) ? true : false;
    }
}
