<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Interfaces\{ApplicationInterface, ContainerInterface, RequestInterface, ResponseInterface};
use Rudra\Container\Traits\InstantiationsTrait;

class Application implements ApplicationInterface
{
    use InstantiationsTrait;

    private static ?ApplicationInterface $application = null;

    public function binding(): ContainerInterface
    {
        return $this->instantiate("binding", Container::class);
    }

    public function setServices(array $services): void
    {
        foreach ($services["contracts"] as $interface => $contract) {
            $this->binding()->set([$interface => $contract]);
        }

        foreach ($services["services"] as $name => $service) {
            $this->objects()->set([$name, $service]);
        }
    }

    public function objects(): ContainerInterface
    {
        return $this->instantiate("objects", Objects::class, $this->binding());
    }

    public function cookie(): ContainerInterface
    {
        return $this->instantiate("cookie", Cookie::class);
    }

    public function session(): ContainerInterface
    {
        return $this->instantiate("session", Session::class);
    }

    public function config(): ContainerInterface
    {
        return $this->instantiate("config", Container::class);
    }

    public function request(): RequestInterface
    {
        return $this->instantiate("request", Request::class);
    }

    public function response(): ResponseInterface
    {
        return $this->instantiate("response", Response::class);
    }

    public static function run(): ApplicationInterface
    {
        if (!static::$application instanceof static) {
            static::$application = new static();
        }

        return static::$application;
    }
}
