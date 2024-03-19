<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

use Rudra\Container\Cookie;
use Rudra\Container\Session;

interface RudraInterface
{
    /**
     * Creates a configuration container
     * ---------------------------------
     * Создает контейнер конфигураций
     * 
     * @param  array $config
     * @return ContainerInterface
     */
    public function config(array $config = []): ContainerInterface;

    /**
     * Creates a container with a list of services
     * -------------------------------------------
     * Создает контейнер со списком серверов
     * 
     * @param  array $services
     * @return ContainerInterface
     */
    public function services(array $services = []): ContainerInterface;

    /**
     * Creates a container to associate interfaces with implementations
     * ----------------------------------------------------------------
     * Создает контейнер для связи интерфейсов с реализациями
     * 
     * @param  array $contracts
     * @return ContainerInterface
     */
    public function binding(array $contracts = []): ContainerInterface;

    /**
     * Containers for the HTTP / 1.1 Common Method Kit
     * -----------------------------------------------
     * Контейнеры для HTTP/1.1 Common Method Kit
     * 
     * @return RequestInterface
     */
    public function request(): RequestInterface;

    /**
     * Initializes the service for different types of responses
     * ------------------------------------------------
     * Инициализирует сервис для разных типов ответов
     * 
     * @return ResponseInterface
     */
    public function response(): ResponseInterface;

    /**
     * Creates the main application singleton
     * --------------------------------------
     * Создает основной синглтон приложения
     * 
     * @return RudraInterface
     */
    public static function run(): RudraInterface;

    /**
     * Initializes the cookie service
     * -------------------------------------------
     * Инициализирует сервис для работы с cookie
     * 
     * @return Cookie
     */
    public function cookie(): Cookie;

    /**
     * Initializes the service for working with sessions
     * -------------------------------------------------
     * Инициализирует сервис для работы с сессиями
     * 
     * @return Session
     */
    public function session(): Session;
}
