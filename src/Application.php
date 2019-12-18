<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Interfaces\{ReflectionInterface,
    ApplicationInterface,
    ContainerInterface,
    CookieInterface,
    SessionInterface,
    ResponseInterface,
    ConfigInterface
};

class Application implements ApplicationInterface, ReflectionInterface
{
    /**
     * @var ApplicationInterface
     */
    private static $app;
    /**
     * @var array
     */
    private $objects = [];
    /**
     * @var array
     */
    private $bind = [];
    /**
     * @var ContainerInterface
     */
    private $request;
    /**
     * @var CookieInterface
     */
    private $cookie;
    /**
     * @var SessionInterface
     */
    private $session;
    /**
     * @var ResponseInterface
     */
    private $response;
    /**
     * @var ConfigInterface
     */
    private $config;

    public function __construct()
    {
        $this->request = new Request();
        $this->cookie = new Cookie();
        $this->session = new Session();
        $this->response = new Response();
        $this->config = new Config();
    }

    /**
     * @return ApplicationInterface
     */
    public static function app(): ApplicationInterface
    {
        if (!static::$app instanceof static) {
            static::$app = new static();
        }

        return static::$app;
    }

    /**
     * @param  string  $key
     * @param        $object
     */
    private function rawSet(string $key, $object)
    {
        $this->objects[$key] = $object;
    }

    /**
     * @param  string  $key
     * @param        $object
     * @param  null  $params
     * @throws \ReflectionException
     */
    private function iOc(string $key, $object, $params = null): void
    {
        $reflection = new \ReflectionClass($object);
        $constructor = $reflection->getConstructor();

        if ($constructor && $constructor->getNumberOfParameters()) {
            $paramsIoC = $this->getParamsIoC($constructor, $params);
            $this->objects[$key] = $reflection->newInstanceArgs($paramsIoC);

            return;
        }

        $this->objects[$key] = new $object();
    }

    /**
     * @param      $object
     * @param  null  $params
     * @return object
     * @throws \ReflectionException
     */
    public function new($object, $params = null)
    {
        $reflection = new \ReflectionClass($object);
        $constructor = $reflection->getConstructor();

        if ($constructor && $constructor->getNumberOfParameters()) {
            $paramsIoC = $this->getParamsIoC($constructor, $params);

            return $reflection->newInstanceArgs($paramsIoC);
        }

        return new $object();
    }

    /**
     * @param  \ReflectionMethod  $constructor
     * @param                  $params
     * @return array
     * @throws \ReflectionException
     */
    private function getParamsIoC(\ReflectionMethod $constructor, $params): array
    {
        $i = 0;
        $paramsIoC = [];

        foreach ($constructor->getParameters() as $value) {
            if (isset($value->getClass()->name) && $this->hasBinding($value->getClass()->name)) {
                $className = $this->getBinding($value->getClass()->name);
                $paramsIoC[] = (is_object($className)) ? $className : new $className;
                continue;
            }

            if ($value->isDefaultValueAvailable() && !isset($params[$i])) {
                $paramsIoC[] = $value->getDefaultValue();
                continue;
            }

            $paramsIoC[] = $params[$i++];
        }

        return $paramsIoC;
    }


    /**
     * @param  string|null  $key
     * @return array|mixed
     */
    public function get(string $key = null)
    {
        return (empty($key)) ? $this->objects : $this->objects[$key];
    }

    /**
     * @param  string  $key
     * @param        $object
     * @param  null  $params
     * @throws \ReflectionException
     */
    public function set(string $key, $object, $params = null)
    {
        ('raw' === $params) ? $this->rawSet($key, $object) : $this->iOc($key, $object, $params);
    }

    /**
     * @param  string  $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($this->objects[$key]);
    }

    /**
     * @param  string  $key
     * @param  string  $param
     * @return mixed
     */
    public function getParam(string $key, string $param)
    {
        if ($this->has($key) && isset($this->get($key)->$param)) {
            return $this->get($key)->$param;
        }
    }

    /**
     * @param  string  $key
     * @param  string  $param
     * @param        $value
     */
    public function setParam(string $key, string $param, $value): void
    {
        if (isset($this->objects[$key])) {
            $this->get($key)->$param = $value;
        }
    }

    /**
     * @param  string  $key
     * @param  string  $param
     * @return bool
     */
    public function hasParam(string $key, string $param)
    {
        if ($this->has($key)) {
            return isset($this->get($key)->$param);
        }
    }

    /**
     * @param  array  $services
     * @throws \ReflectionException
     */
    public function setServices(array $services): void
    {
        foreach ($services['contracts'] as $interface => $contract) {
            $this->setBinding($interface, $contract);
        }

        foreach ($services['services'] as $name => $service) {
            $this->set($name, ...$service);
        }
    }

    /**
     * @param  string  $key
     * @return mixed|string
     */
    public function getBinding(string $key)
    {
        return $this->bind[$key] ?? $key;
    }

    /**
     * @param  string  $key
     * @return bool
     */
    public function hasBinding(string $key): bool
    {
        return array_key_exists($key, $this->bind);
    }

    /**
     * @param  string  $key
     * @param        $value
     */
    public function setBinding(string $key, $value): void
    {
        $this->bind[$key] = $value;
    }

    /**
     * @return Request
     */
    public function request(): Request
    {
        return $this->request;
    }

    /**
     * @return ContainerInterface
     */
    public function cookie(): ContainerInterface
    {
        return $this->cookie;
    }

    /**
     * @return ContainerInterface
     */
    public function session(): ContainerInterface
    {
        return $this->session;
    }

    /**
     * @return ResponseInterface
     */
    public function response(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * @return ContainerInterface
     */
    public function config(): ContainerInterface
    {
        return $this->config;
    }
}
