<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

interface ContainerInterface
{
    /**
     * @param  string|null $key
     * @return void
     * 
     * Gets the container element
     * --------------------------
     * Получает элемент контейнера
     */
    public function get(string $key = null);

    /**
     * @param  array $data
     * @return void
     * 
     * Adds data to the container
     * --------------------------
     * Добавляет данные в контейнер
     */
    public function set(array $data): void;

    /**
     * @param  string  $key
     * @return boolean
     * 
     * Checks if the element is in the container
     * -----------------------------------------
     * Проверяет наличие элемента в контейнере
     */
    public function has(string $key): bool;
}
