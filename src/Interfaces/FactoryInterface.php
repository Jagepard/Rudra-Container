<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

 namespace Rudra\Container\Interfaces;

 interface FactoryInterface
 {
    /**
     * Creates an object
     * -----------------
     * Создает объект
     *
     * @return object
     */
    public function create(): object;
 }
 