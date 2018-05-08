<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2016, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra\Traits;

/**
 * Trait ContainerGlobalsTrait
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
    protected $put;
    /**
     * @var array
     */
    protected $patch;
    /**
     * @var array
     */
    protected $delete;
    /**
     * @var array
     */
    protected $server;
    /**
     * @var array
     */
    protected $files;

    /**
     * @param string|null $key
     * @return array
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
     * @return bool
     */
    public function hasGet(string $key): bool
    {
        return isset($this->get[$key]);
    }

    /**
     * @param string|null $key
     * @return array
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
     * @return bool
     */
    public function hasPost(string $key): bool
    {
        return isset($this->post[$key]);
    }

    /**
     * @param string|null $key
     * @return array|null
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
     * @return string
     */
    public function getUpload(string $key, string $fieldName, string $formName = 'upload'): string
    {
        return $this->files[$formName][$fieldName][$key];
    }

    /**
     * @param string $value
     * @param string $formName
     * @return bool
     */
    public function isUploaded(string $value, string $formName = 'upload'): bool
    {
        return isset($this->files[$formName]['name'][$value])
            ? ($this->files[$formName]['name'][$value] !== '')
            : false;
    }

    /**
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function isFileType(string $key, string $value): bool
    {
        return ($this->files['type'][$key] == $value) ? true : false;
    }

    /**
     * @param string|null $key
     * @return array
     */
    public function getPut(string $key = null)
    {
        return empty($key) ? $this->put : $this->put[$key];
    }

    /**
     * @param array $put
     */
    public function setPut(array $put): void
    {
        $this->put = $put;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasPut(string $key): bool
    {
        return isset($this->put[$key]);
    }

    /**
     * @param string|null $key
     * @return array
     */
    public function getPatch(string $key = null)
    {
        return empty($key) ? $this->patch : $this->patch[$key];
    }

    /**
     * @param array $patch
     */
    public function setPatch(array $patch): void
    {
        $this->patch = $patch;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasPatch(string $key): bool
    {
        return isset($this->patch[$key]);
    }

    /**
     * @param string|null $key
     * @return array
     */
    public function getDelete(string $key = null)
    {
        return empty($key) ? $this->delete : $this->delete[$key];
    }

    /**
     * @param array $delete
     */
    public function setDelete(array $delete): void
    {
        $this->delete = $delete;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasDelete(string $key): bool
    {
        return isset($this->delete[$key]);
    }
}
