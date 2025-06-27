<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Container\Traits;

use Rudra\Container\Facades\Rudra;

trait FacadeTrait
{
    /**
     * Handles static method calls for the Facade class.
     * It dynamically resolves the underlying class name by removing "Facade" from the class name.
     * If the resolved class does not exist, it attempts to clean up the class name by removing spaces.
     * If the resolved class is not already registered in the container, it registers it.
     * Finally, it delegates the static method call to the resolved class instance.
     * -------------------------
     * Обрабатывает статические вызовы методов для класса Facade.
     * Динамически разрешает имя базового класса, удаляя "Facade" из имени класса.
     * Если разрешённый класс не существует, пытается очистить имя класса, удаляя пробелы.
     * Если разрешённый класс ещё не зарегистрирован в контейнере, он регистрируется.
     * В конце делегирует статический вызов метода экземпляру разрешённого класса.
     *
     * @param  string $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic(string $method, array $parameters = []): mixed
    {
        $className = str_replace("Facade", "", static::class);

        if (!class_exists($className)) { 
            $className = str_replace("\s", "", $className);
        }

        if (!Rudra::has($className)) {
            Rudra::set([$className, [$className]]);
        }

        return Rudra::get($className)->$method(...$parameters);
    }
}
