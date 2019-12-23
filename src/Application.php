<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Interfaces\{ApplicationInterface, ContainerInterface, RequestInterface, ResponseInterface};

class Application implements ApplicationInterface
{
    /**
     * @var ApplicationInterface
     */
    public static $application;
    /**
     * @var array
     */
    private $instances = [];

    /**
     * @return ApplicationInterface
     */
    public static function run(): ApplicationInterface
    {
        if (!static::$application instanceof static) {
            static::$application = new static();
        }

        return static::$application;
    }

    /**
     * @param  array  $services
     * @throws \ReflectionException
     */
    public function setServices(array $services): void
    {
        foreach ($services['contracts'] as $interface => $contract) {
            $this->binding()->set([$interface => $contract]);
        }

        foreach ($services['services'] as $name => $service) {
            $this->di()->set([$name, $service]);
        }
    }

    /**
     * @return ContainerInterface
     */
    public function di(): ContainerInterface
    {
        return $this->instantiate('objects', Di::class, $this->binding());
    }

    /**
     * @return RequestInterface
     */
    public function request(): RequestInterface
    {
        return $this->instantiate('request', Request::class);
    }

    /**
     * @return ContainerInterface
     */
    public function cookie(): ContainerInterface
    {
        return $this->instantiate('cookie', Cookie::class);
    }

    /**
     * @return ContainerInterface
     */
    public function session(): ContainerInterface
    {
        return $this->instantiate('session', Session::class);
    }

    /**
     * @return ResponseInterface
     */
    public function response(): ResponseInterface
    {
        return $this->instantiate('response', Response::class);
    }

    /**
     * @return ContainerInterface
     */
    public function config(): ContainerInterface
    {
        return $this->instantiate('config', Container::class);
    }

    /**
     * @return ContainerInterface
     */
    public function binding(): ContainerInterface
    {
        return $this->instantiate('binding', Container::class);
    }

    /**
     * @param $varName
     * @param $instance
     * @param $data
     * @return mixed
     */
    private function instantiate($varName, $instance, $data = null)
    {
        if (!array_key_exists($varName, $this->instances)) {
            $this->instances[$varName] = new $instance($data);
        }

        return $this->instances[$varName];
    }
}
