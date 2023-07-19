<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Interfaces\ContainerInterface;

class Container implements ContainerInterface
{
    protected array $data = [];

    /**
     * @param  array $data
     * 
     * Устанавливает данные
     * --------------------
     * Sets data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param  string|null $key
     * @return void
     * 
     * Получает элемент по ключу или весь массив данных
     * ------------------------------------------------
     * Gets an element by key or the entire array of data
     */
    public function get(string $key = null)
    {
        if (empty($key)) {
            return $this->data;
        }

        if (!array_key_exists($key, $this->data)) {
            throw new \InvalidArgumentException("'$key' is not isset");
        }

        return $this->data[$key];
    }

    /**
     * @param  array $data
     * 
     * Устанавливает данные
     * --------------------
     * Sets data
     */
    public function set(array $data): void
    {
        $this->data = array_merge($this->data, $data);
    }

    /**
     * @param  string  $key
     * @return boolean
     * 
     * Проверяет наличие данных по ключу
     * ---------------------------------
     * Checks for the existence of data by key
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }
}
