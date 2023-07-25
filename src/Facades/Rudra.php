<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Facades;

use Rudra\Container\Cookie;
use Rudra\Container\Session;
use Rudra\Container\Interfaces\RudraInterface;
use Rudra\Container\Interfaces\RequestInterface;
use Rudra\Container\Interfaces\ResponseInterface;
use Rudra\Container\Interfaces\ContainerInterface;

/**
 * @method static ContainerInterface binding(array $contracts = [])
 * @method static ContainerInterface serviceList(array $services = [])
 * @method static ContainerInterface config(array $config = [])
 * @method static ContainerInterface data($data = null)
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
