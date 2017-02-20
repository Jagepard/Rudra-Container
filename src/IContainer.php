<?php

/**
 * Date: 15.03.16
 * Time: 20:35
 *
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2016, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra;

/**
 * Interface IContainer
 *
 * @package Rudra
 */
interface IContainer
{

    /**
     * @param $key
     *
     * @return mixed
     */
    public function get($key);

    /**
     * @param $key
     * @param $object
     */
    public function set($key, $object);

    /**
     * @param      $object
     * @param null $params
     *
     * @return mixed
     */
    public function new($object, $params = null);

    /**
     * @param $key
     *
     * @return bool
     */
    public function has($key);

    /**
     * @param $key
     * @param $param
     *
     * @return mixed
     */
    public function getParam($key, $param);

    /**
     * @param $key
     * @param $param
     * @param $value
     */
    public function setParam($key, $param, $value);

    /**
     * @param $key
     * @param $param
     *
     * @return mixed
     */
    public function hasParam($key, $param);

    /**
     * @param string $key
     *
     * @return string
     */
    public function getGet($key);

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasGet(string $key): bool;

    /**
     * @param $key
     *
     * @return mixed
     */
    public function getPost($key);

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
    public function getServer(string $key): string;

    /**
     * @param string $key
     * @param string $subKey
     *
     * @return string
     */
    public function getSession(string $key, string $subKey): string;

    /**
     * @param string $key
     * @param string $value
     * @param string $subKey
     */
    public function setSession(string $key, string $value, string $subKey);

    /**
     * @param string $key
     * @param string $subKey
     *
     * @return bool
     */
    public function hasSession(string $key, string $subKey): bool;

    /**
     * @param string $key
     * @param string $subKey
     */
    public function unsetSession(string $key, string $subKey);

    public function startSession();

    public function stopSession();

    public function clearSession();

    /**
     * @param string $key
     * @param string $fieldName
     *
     * @return string
     */
    public function getUpload(string $key, string $fieldName) : string;

    /**
     * @param string $value
     * @param        $formName
     *
     * @return bool
     */
    public function isUploaded(string $value, $formName) : bool;

    /**
     * @param string $key
     * @param string $value
     *
     * @return bool
     */
    public function isFileType(string $key, string $value) : bool;

    /**
     * @param $key
     *
     * @return mixed
     */
    public function getCookie(string $key): string;

    /**
     * @param string $key
     * @param string $value
     */
    public function setCookie(string $key, string $value);

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function hasCookie(string $key);

    /**
     * @param string $key
     */
    public function unsetCookie(string $key);

    /**
     * @param $key
     *
     * @return mixed
     */
    public function getBinding($key);

    /**
     * @param $key
     * @param $value
     */
    public function setBinding($key, $value);

}
