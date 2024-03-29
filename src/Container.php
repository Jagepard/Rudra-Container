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
     * Sets data
     * ---------
     * Устанавливает данные
     * 
     * @param  array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Gets an element by key or the entire array of data
     * --------------------------------------------------
     * Получает элемент по ключу или весь массив данных
     * 
     * @param  string|null $key
     * @return mixed
     */
    public function get(string $key = null): mixed
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
     * Sets data
     * ---------
     * Устанавливает данные
     * 
     * @param  array $data
     */
    public function set(array $data): void
    {
        $this->data = array_merge($this->data, $data);
    }

    /**
     * Checks for the existence of data by key
     * ---------------------------------------
     * Проверяет наличие данных по ключу
     * 
     * @param  string  $key
     * @return boolean
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }
}
