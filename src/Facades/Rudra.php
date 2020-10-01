<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Facades;

use Rudra\Container\{Cookie, Session};
use Rudra\Container\Interfaces\{RequestInterface, ResponseInterface, ContainerInterface, RudraInterface};

/**
 * @method static void setServices(array $services)
 * @method static ContainerInterface binding()
 * @method static ContainerInterface services()
 * @method static ContainerInterface config()
 * @method static RequestInterface request()
 * @method static ResponseInterface response()
 * @method static Cookie cookie()
 * @method static Session session()
 * @method static new($object, $params = null)
 * @method static RudraInterface run()
 * @method static get(string $key = null)
 * @method static void set(array $data)
 * @method static bool has(string $key)
 *
 * @see \Rudra\Container\Rudra
 */
final class Rudra
{
    public static function __callStatic($method, $parameters = [])
    {
        return \Rudra\Container\Rudra::run()->$method(...$parameters);
    }
}
