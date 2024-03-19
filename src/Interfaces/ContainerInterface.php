<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

interface ContainerInterface
{
    /**
     * Gets the container element
     * --------------------------
     * Получает элемент контейнера
     * 
     * @param  string|null $key
     * @return mixed
     */
    public function get(string $key = null): mixed;

    /**
     * Adds data to the container
     * --------------------------
     * Добавляет данные в контейнер
     * 
     * @param  array $data
     * @return void
     */
    public function set(array $data): void;

    /**
     * Checks if the element is in the container
     * -----------------------------------------
     * Проверяет наличие элемента в контейнере
     * 
     * @param  string  $key
     * @return boolean
     */
    public function has(string $key): bool;
}
