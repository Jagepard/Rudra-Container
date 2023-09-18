<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

/**
 * @deprecated
 */
class Files extends Container
{
    /**
     * @deprecated
     *
     * @param  string $key
     * @param  string $fieldName
     * @param  string $formName
     * @return string
     */
    public function getLoaded(string $key, string $fieldName, string $formName = "upload"): string
    {
        return $this->data[$formName][$fieldName][$key];
    }

    /**
     * @deprecated
     *
     * @param  string  $value
     * @param  string  $formName
     * @return boolean
     */
    public function isLoaded(string $value, string $formName = "upload"): bool
    {
        return isset($this->data[$formName]["name"][$value]) && $this->data[$formName]["name"][$value] !== '';
    }

    /**
     * @deprecated
     *
     * @param  string  $key
     * @param  string  $value
     * @return boolean
     */
    public function isFileType(string $key, string $value): bool
    {
        return $this->data["type"][$key] == $value;
    }
}
