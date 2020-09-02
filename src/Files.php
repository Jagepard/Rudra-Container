<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

class Files extends Container
{
    public function getLoaded(string $key, string $fieldName, string $formName = "upload"): string
    {
        return $this->data[$formName][$fieldName][$key];
    }

    public function isLoaded(string $value, string $formName = "upload"): bool
    {
        return isset($this->data[$formName]["name"][$value])
            ? ($this->data[$formName]["name"][$value] !== '')
            : false;
    }

    public function isFileType(string $key, string $value): bool
    {
        return ($this->data["type"][$key] == $value) ? true : false;
    }
}
