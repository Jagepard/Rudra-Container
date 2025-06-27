<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

interface RudraInterface
{
    /**
     * Implements the Singleton pattern to ensure only one instance of the class is created.
     * If the instance does not exist, it creates and stores it. Otherwise, it returns the existing instance.
     * -------------------------
     * Реализует паттерн Singleton, чтобы гарантировать создание только одного экземпляра класса.
     * Если экземпляр не существует, он создаётся и сохраняется. В противном случае возвращается существующий экземпляр.
     *
     * @return RudraInterface
     */
    public static function run(): RudraInterface;
}
