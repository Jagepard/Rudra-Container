<?php

declare(strict_types=1);

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
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
