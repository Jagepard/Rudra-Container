<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Facades;

use Rudra\Container\{
    Cookie,
    Session,
    Interfaces\RudraInterface,
    Interfaces\RequestInterface,
    Interfaces\ResponseInterface,
    Interfaces\ContainerInterface
};

/**
 * @method static Cookie cookie()
 * @method static Session session()
 * @method static RudraInterface run()
 * @method static void set(array $data)
 * @method static bool has(string $key)
 * @method static RequestInterface request()
 * @method static ResponseInterface response()
 * @method static mixed get(string $key = null)
 * @method static object new($object, $params = null)
 * @method static ContainerInterface shared($data = null)
 * @method static ContainerInterface config(array $config = [])
 * @method static ContainerInterface waiting(array $services = [])
 * @method static ContainerInterface binding(array $contracts = [])
 * @method static autowire($object, string $method, ?array $params = null)
 *
 * @see \Rudra\Container\Rudra
 */
final class Rudra
{
    /**
     * @param $method
     * @param array $parameters
     *
     * @return mixed
     */
    public static function __callStatic($method, array $parameters = [])
    {
        return \Rudra\Container\Rudra::run()->$method(...$parameters);
    }
}
