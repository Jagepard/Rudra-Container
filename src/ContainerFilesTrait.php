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
trait ContainerFilesTrait
{

    /**
     * @var array
     */
    protected $files;

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