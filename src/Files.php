<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

class Files extends Container
{
    /**
     * @param  string  $key
     * @param  string  $fieldName
     * @param  string  $formName
     * @return string
     */
    public function getLoaded(string $key, string $fieldName, string $formName = 'upload'): string
    {
        return $this->data[$formName][$fieldName][$key];
    }

    /**
     * @param  string  $value
     * @param  string  $formName
     * @return bool
     */
    public function isLoaded(string $value, string $formName = 'upload'): bool
    {
        return isset($this->data[$formName]['name'][$value])
            ? ($this->data[$formName]['name'][$value] !== '')
            : false;
    }

    /**
     * @param  string  $key
     * @param  string  $value
     * @return bool
     */
    public function isFileType(string $key, string $value): bool
    {
        return ($this->data['type'][$key] == $value) ? true : false;
    }
}
