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
 * @package Rudra
 */
interface IContainer
{

    /**
     * @param $key
     * @return mixed
     */
    public function get($key);

    /**
     * @param $key
     * @param $object
     */
    public function set($key, $object);

    /**
     * @param $key
     * @param $param
     * @param $value
     */
    public function setParam($key, $param, $value);

    /**
     * @param $key
     * @return bool
     */
    public function has($key);

    /**
     * @param $key
     * @param $param
     * @return mixed
     */
    public function getParam($key, $param);

    /**
     * @param string $key
     * @return string
     */
    public function getServer(string $key): string;

    /**
     * @param string $key
     * @return bool
     */
    public function hasPost(string $key): bool;

    /**
     * @param string $key
     * @return string
     */
    public function getPost(string $key): string;

    /**
     * @return mixed
     */
    public function getAllPost();

    /**
     * @param $key
     * @param $value
     */
    public function setSession(string $key, string $value);

    /**
     * @param string $key
     * @param string $subKey
     * @param string $value
     */
    public function setSubSession(string $key, string $subKey, string $value);

    /**
     * @param string $key
     */
    public function unsetSession(string $key);

    /**
     * @param string $key
     * @return string
     */
    public function getGet(string $key): string;

    /**
     * @param string $key
     * @return bool
     */
    public function hasGet(string $key): bool;

    /**
     * @param $key
     * @return mixed
     */
    public function getSession(string $key): string;

    /**
     * @param string $key
     * @param string $subKey
     * @return string
     */
    public function getSubSession(string $key, string $subKey): string;

    /**
     * @param $key
     * @return bool
     */
    public function hasSession(string $key): bool;

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
     * @return bool
     */
    public function isFileType(string $key) : bool;

    /**
     * @param string $key
     * @param string $subKey
     * @return bool
     */
    public function hasSubSession(string $key, string $subKey): bool;

    public function startSession();

    public function stopSession();

    public function clearSession();

    /**
     * @param $key
     * @return mixed
     */
    public function getCoockie(string $key): string;

    /**
     * @param string $key
     */
    public function unsetCoockie(string $key);

    /**
     * @param string $key
     * @param string $value
     */
    public function setCoockie(string $key, string $value);

    /**
     * @param string $key
     * @return mixed
     */
    public function hasCoockie(string $key);

}
