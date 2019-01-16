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

    // ContainerConfigInterface

    /**
     * @param string      $key
     * @param string|null $subKey
     * @return mixed
     */
    public function config(string $key, string $subKey = null);

    /**
     * @param array $config
     */
    public function setConfig(array $config): void;

    /**
     * @return array
     */
    public function getConfig(): array;

    /**
     * @param $key
     * @param $value
     */
    public function addConfig($key, $value): void;

    // ContainerCookieInterface

    /**
     * @param string $key
     * @return string
     */
    public function getCookie(string $key): string;

    /**
     * @param string $key
     * @return bool
     */
    public function hasCookie(string $key): bool;

    /**
     * @codeCoverageIgnore
     * @param string $key
     */
    public function unsetCookie(string $key): void;

    /**
     * @param string $key
     * @param string $value
     */
    public function setCookie(string $key, string $value): void;

    // ContainerSessionInterface

    /**
     * @param string      $key
     * @param string|null $subKey
     * @return mixed
     */
    public function getSession(string $key, string $subKey = null);

    /**
     * @param string      $key
     * @param             $value
     * @param string|null $subKey
     */
    public function setSession(string $key, $value, string $subKey = null): void;

    /**
     * @param string      $key
     * @param string|null $subKey
     * @return bool
     */
    public function hasSession(string $key, string $subKey = null): bool;

    /**
     * @param string      $key
     * @param string|null $subKey
     */
    public function unsetSession(string $key, string $subKey = null): void;

    /**
     * @codeCoverageIgnore
     */
    public function startSession(): void;

    /**
     * @codeCoverageIgnore
     */
    public function stopSession(): void;

    public function clearSession(): void;

    // ContainerGlobalInterface

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

    // ContainerReflectionInterface

    /**
     * @param      $object
     * @param null $params
     * @return mixed|object
     */
    public function new($object, $params = null);

    /**
     * @param string|null $key
     * @return array|mixed
     */
    public function get(string $key = null);

    /**
     * @param string $key
     * @param        $object
     * @param null   $params
     * @return object|void
     */
    public function set(string $key, $object, $params = null);

    /**
     * @param string $key
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
     * @return bool
     */
    public function hasParam(string $key, string $param);

    /**
     * @param string $key
     * @return mixed|string
     */
    public function getBinding(string $key);

    /**
     * @param string $key
     * @param        $value
     */
    public function setBinding(string $key, $value): void;

    // ContainerResponseInterface

    /**
     * @codeCoverageIgnore
     * @param array $data
     */
    public function jsonResponse(array $data): void;
}
