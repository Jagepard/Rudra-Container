<?php

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Container\Interfaces;

interface RudraInterface
{
    /**
     * Creates the main application singleton
     * --------------------------------------
     * Создает основной синглтон приложения
     *
     * @return RudraInterface
     */
    public static function run(): RudraInterface;
}
