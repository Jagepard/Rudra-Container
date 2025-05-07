<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Psr\Container\ContainerInterface; 
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;

/**
 * Service container implementing the PSR-11 standard.
 * ---------------------------------------------------
 * Контейнер сервисов, реализующий стандарт PSR-11.
 */
class Container implements ContainerInterface
{
    /**
     * Constructor of the class.
     * Initializes the container with initial data.
     * --------------------------------------------
     * Конструктор класса.
     * Инициализирует контейнер начальными данными.
     *
     * @param array $data
     */
    public function __construct(protected array $data = []) {}

    /**
     * Retrieves an element from the container by its identifier.
     * ----------------------------------------------------------
     * Получает элемент из контейнера по его идентификатору.
     *
     * @param string $id
     * @return mixed
     * @throws NotFoundExceptionInterface
     */
    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new class("'$id' is not found") extends \Exception implements NotFoundExceptionInterface {};
        }

        return $this->data[$id];
    }

    /**
     * Returns all data stored in the container.
     * -----------------------------------------------
     * Возвращает все данные, хранящиеся в контейнере.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->data;
    }

    /**
     * Adds or updates data in the container.
     * --------------------------------------------
     * Добавляет или обновляет данные в контейнере.
     * 
     * @param  array $data
     */
    public function set(array $data): void
    {
        $this->data = array_merge($this->data, $data);
    }

    /**
     * Checks for the existence of an element in the container by its key.
     * -------------------------------------------------------------------
     * Проверяет наличие элемента в контейнере по ключу.
     * 
     * @param  string  $id
     * @return boolean
     */
    public function has(string $id): bool
    {
        return array_key_exists($id, $this->data);
    }
}
