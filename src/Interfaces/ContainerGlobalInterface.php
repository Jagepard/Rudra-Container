<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra\Container\Interfaces;

/**
 * Interface ContainerGlobalScopeInterface
 * @package Rudra
 */
interface ContainerGlobalInterface
{

    /**
     * @param string|null $key
     * @return array
     */
    public function getGet(string $key = null);

    /**
     * @param array $get
     */
    public function setGet(array $get): void;

    /**
     * @param string $key
     * @return bool
     */
    public function hasGet(string $key): bool;

    /**
     * @param string|null $key
     * @return array
     */
    public function getPost(string $key = null);

    /**
     * @param array $post
     */
    public function setPost(array $post): void;

    /**
     * @param string $key
     * @return bool
     */
    public function hasPost(string $key): bool;

    /**
     * @param string|null $key
     * @return array|null
     */
    public function getServer(string $key = null);

    /**
     * @param string $key
     * @param string $value
     */
    public function setServer(string $key, string $value);

    /**
     * @param array $files
     */
    public function setFiles(array $files);

    /**
     * @param string $key
     * @param string $fieldName
     * @param string $formName
     * @return string
     */
    public function getUpload(string $key, string $fieldName, string $formName = 'upload'): string;
    /**
     * @param string $value
     * @param string $formName
     * @return bool
     */
    public function isUploaded(string $value, string $formName = 'upload'): bool;

    /**
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function isFileType(string $key, string $value): bool;

    /**
     * @param string|null $key
     * @return array
     */
    public function getPut(string $key = null);

    /**
     * @param array $put
     */
    public function setPut(array $put): void;

    /**
     * @param string $key
     * @return bool
     */
    public function hasPut(string $key): bool;

    /**
     * @param string|null $key
     * @return array
     */
    public function getPatch(string $key = null);

    /**
     * @param array $patch
     */
    public function setPatch(array $patch): void;

    /**
     * @param string $key
     * @return bool
     */
    public function hasPatch(string $key): bool;

    /**
     * @param string|null $key
     * @return array
     */
    public function getDelete(string $key = null);

    /**
     * @param array $delete
     */
    public function setDelete(array $delete): void;

    /**
     * @param string $key
     * @return bool
     */
    public function hasDelete(string $key): bool;
}
