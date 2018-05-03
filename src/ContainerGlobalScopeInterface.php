<?php
/**
 * Date: 03.05.18
 * Time: 18:12
 *
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra;


/**
 * Interface ContainerGlobalScopeInterface
 * @package Rudra
 */
interface ContainerGlobalScopeInterface
{

    /**
     * @param string|null $key
     *
     * @return mixed
     */
    public function getGet(string $key = null);

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasGet(string $key): bool;

    /**
     * @param string|null $key
     *
     * @return mixed
     */
    public function getPost(string $key = null);

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasPost(string $key): bool;

    /**
     * @param string $key
     *
     * @return string
     */
    public function getServer(string $key = null);

    /**
     * @param string $key
     * @param string $subKey
     *
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
     * @param string $key
     * @param string $subKey
     *
     * @return bool
     */
    public function hasSession(string $key, string $subKey = null): bool;

    /**
     * @param string      $key
     * @param string|null $subKey
     */
    public function unsetSession(string $key, string $subKey = null): void;

    public function startSession(): void;

    public function stopSession(): void;

    public function clearSession(): void;

    /**
     * @param string $key
     * @param string $fieldName
     * @param string $formName
     *
     * @return string
     */
    public function getUpload(string $key, string $fieldName, string $formName) : string;

    /**
     * @param string $value
     * @param string $formName
     *
     * @return bool
     */
    public function isUploaded(string $value, string $formName) : bool;

    /**
     * @param string $key
     * @param string $value
     *
     * @return bool
     */
    public function isFileType(string $key, string $value) : bool;

    /**
     * @param string $key
     *
     * @return string
     */
    public function getCookie(string $key): string;

    /**
     * @param string $key
     * @param string $value
     */
    public function setCookie(string $key, string $value): void;

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function hasCookie(string $key);

    /**
     * @param string $key
     */
    public function unsetCookie(string $key): void;

    /**
     * @param string      $key
     * @param string|null $subKey
     *
     * @return array|mixed
     */
    public function config(string $key, string $subKey = null);

    /**
     * @param array $config
     */
    public function setConfig(array $config);
}