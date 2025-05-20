<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
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
 * @method static bool has(string $id)
 * @method static RudraInterface run()
 * @method static void set(array $data)
 * @method static mixed get(string $id)
 * @method static RequestInterface request()
 * @method static ResponseInterface response()
 * @method static object new($object, $params = null)
 * @method static ContainerInterface shared($data = null)
 * @method static ContainerInterface config(array $config = [])
 * @method static ContainerInterface waiting(array $services = [])
 * @method static ContainerInterface binding(array $contracts = [])
 * @method static mixed autowire($object, string $method, ?array $params = null)
 * @method static array getParamsIoC(ReflectionMethod $constructor, ?array $params)
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
