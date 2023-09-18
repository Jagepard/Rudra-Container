<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

use Rudra\Container\Files;

interface RequestInterface
{
    /**
     * Creates a container for HTTP GET variables
     * ------------------------------------------
     * Создает контейнер для переменных HTTP GET
     *
     * @return ContainerInterface
     */
    public function get(): ContainerInterface;

    /**
     * Creates a container for HTTP POST variables
     * ------------------------------------------
     * Создает контейнер для переменных HTTP POST
     *
     * @return ContainerInterface
     */
    public function post(): ContainerInterface;

    /**
     * Creates a container for HTTP PUT variables
     * ------------------------------------------
     * Создает контейнер для переменных HTTP PUT
     *
     * @return ContainerInterface
     */
    public function put(): ContainerInterface;

    /**
     * Creates a container for HTTP PATCH variables
     * ------------------------------------------
     * Создает контейнер для переменных HTTP PATCH
     *
     * @return ContainerInterface
     */
    public function patch(): ContainerInterface;

    /**
     * Creates a container for HTTP DELETE variables
     * ------------------------------------------
     * Создает контейнер для переменных HTTP DELETE
     *
     * @return ContainerInterface
     */
    public function delete(): ContainerInterface;

    /**
     * Creates a container for server and execution environment information
     * --------------------------------------------------------------------
     * Создает контейнер для информации о сервере и среде исполнения
     *
     * @return ContainerInterface
     */
    public function server(): ContainerInterface;

    /**
     * Creates a container for HTTP File Upload variables
     * --------------------------------------------------
     * Создает контейнер для переменных файлов, загруженных по HTTP
     *
     * @return Files
     */
    public function files(): Files;
}
