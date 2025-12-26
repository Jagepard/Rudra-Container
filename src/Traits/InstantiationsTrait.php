<?php declare(strict_types=1);

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
 */

namespace Rudra\Container\Traits;

use ReflectionException;
use Psr\Container\ContainerInterface;

trait InstantiationsTrait
{
    private array $containers = [];

    /**
     * Creates and stores a container instance if it does not already exist.
     * If the container for the given name does not exist in the `containers` array, 
     * it creates a new instance of the specified class with the provided data and stores it.
     * Otherwise, it returns the existing container instance.
     * -------------------------
     * Создаёт и сохраняет экземпляр контейнера, если он ещё не существует.
     * Если контейнер с указанным именем отсутствует в массиве `containers`, 
     * создаётся новый экземпляр указанного класса с предоставленными данными и сохраняется.
     * В противном случае возвращается существующий экземпляр контейнера.
     *
     * @param  string             $name
     * @param  string             $instance
     * @param  array              $data
     * @return ContainerInterface
     */
    private function containerize(string $name, string $instance, array $data = []): ContainerInterface
    {
        return $this->containers[$name] ??= new $instance($data);
    }

    /**
     * Initializes and retrieves an instance of a class or service.
     * If the instance is not already registered in the container, it registers it with the provided data.
     * The method uses the class name as the default instance if no specific instance is provided.
     * -------------------------
     * Инициализирует и извлекает экземпляр класса или сервиса.
     * Если экземпляр ещё не зарегистрирован в контейнере, он регистрируется с предоставленными данными.
     * Метод использует имя класса в качестве экземпляра по умолчанию, если конкретный экземпляр не указан.
     *
     * @param  string      $name
     * @param  string|null $instance
     * @param  array       $data
     * @return mixed
     */
    private function init(string $name, string $instance = null, array $data = []): mixed
    {
        $instance ??= $name;
        !$this->has($name) && $this->set([$name, [$instance, $data]]);
        return $this->get($instance);
    }
}
