<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Interfaces\RudraInterface;
use Rudra\Container\Interfaces\RequestInterface;
use Rudra\Container\Interfaces\ResponseInterface;
use Rudra\Container\Interfaces\ContainerInterface;
use Rudra\Container\Traits\InstantiationsTrait;

class Rudra implements RudraInterface, ContainerInterface
{
    use InstantiationsTrait;

    public static ?RudraInterface $rudra = null;

    /**
     * @param  array              $contracts
     * @return ContainerInterface
     * 
     * Creates a container to associate interfaces with implementations
     * ----------------------------------------------------------------
     * Создает контейнер для связи интерфейсов с реализациями
     */
    public function binding(array $contracts = []): ContainerInterface
    {
        return $this->containerize("binding", Container::class, $contracts);
    }

    /**
     * @param  array              $services
     * @return ContainerInterface
     * 
     * Creates a container with a list of services
     * -------------------------------------------
     * Создает контейнер со списком серверов
     * 
     */
    public function serviceList(array $services = []): ContainerInterface
    {
        return $this->containerize("services", Container::class, $services);
    }
    
    /**
     * @param  array              $config
     * @return ContainerInterface
     * 
     * Creates a configuration container
     * ---------------------------------
     * Создает контейнер конфигураций
     */
    public function config(array $config = []): ContainerInterface
    {
        return $this->containerize("config", Container::class, $config);
    }

    /**
     * @param  array              $data
     * @return ContainerInterface
     * 
     * Creates a container for storing data
     * ------------------------------------
     * Создает контейнер для хранения данных
     */
    public function data(array $data = []): ContainerInterface
    {
        return $this->containerize("data", Container::class, $data);
    }
    
    /**
     * @return RequestInterface
     * 
     * Initializes the service
     * -----------------------
     * Иницианализирует сервис
     */
    public function request(): RequestInterface
    {
        return $this->init(Request::class);
    }

    /**
     * @return ResponseInterface
     * 
     * Initializes the service
     * -----------------------
     * Иницианализирует сервис
     */
    public function response(): ResponseInterface
    {
        return $this->init(Response::class);
    }

    /**
     * @return Cookie
     * 
     * Initializes the service
     * -----------------------
     * Иницианализирует сервис
     */
    public function cookie(): Cookie
    {
        return $this->init(Cookie::class);
    }

    /**
     * @return Session
     * 
     * Initializes the service
     * -----------------------
     * Иницианализирует сервис
     */
    public function session(): Session
    {
        return $this->init(Session::class);
    }

    /**
     * @param  [type] $object
     * @param  [type] $params
     * @return void
     * 
     * Creates an object without adding to the container
     * -------------------------------------------------
     * Создает объект без добавления в контейнер
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

    public static function run(): RudraInterface
    {
        if (!static::$rudra instanceof static) {
            static::$rudra = new static();
        }

        return static::$rudra;
    }

    public function get(string $key = null)
    {
        if (isset($key) && !$this->has($key)) {
            if (!$this->serviceList()->has($key)) {
                if (class_exists($key)) {
                    $this->serviceList()->set([$key => $key]);
                } else {
                    throw new \InvalidArgumentException("Service '$key' is not installed");
                }
            }

            $this->set([$key, $this->serviceList()->get($key)]);
        }

        if (empty($key)) {
            return $this->services;
        }

        return ($this->services[$key] instanceof \Closure) ? $this->services[$key]() : $this->services[$key];
    }

    public function set(array $data): void
    {
        list($key, $object) = $data;

        if (is_array($object)) {
            if (array_key_exists(1, $object) && !is_object($object[0])) {
                $this->iOc($key, $object[0], $object[1]);
                return;
            }

            $this->setObject($key, $object[0]);
            return;
        }

        $this->setObject($key, $object);
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->services);
    }

    private function setObject($key, $object): void
    {
        (is_object($object)) ? $this->mergeData($key, $object) : $this->iOc($key, $object);
    }

    private function mergeData(string $key, $object)
    {
        $this->services = array_merge([$key => $object], $this->services);
    }

    private function iOc(string $key, $object, $params = null): void
    {
        $reflection = new \ReflectionClass($object);
        $constructor = $reflection->getConstructor();

        if ($constructor && $constructor->getNumberOfParameters()) {
            $paramsIoC = $this->getParamsIoC($constructor, $params);
            $this->mergeData($key, $reflection->newInstanceArgs($paramsIoC));
            return;
        }

        $this->mergeData($key, new $object());
    }

    private function getParamsIoC(\ReflectionMethod $constructor, $params): array
    {
        $i = 0;
        $paramsIoC = [];
        $params = (is_array($params) && array_key_exists(0, $params)) ? $params : [$params];

        foreach ($constructor->getParameters() as $value) {
            /*
             | If in the constructor expects the implementation of interface,
             | so that the container automatically created the necessary object and substituted as an argument,
             | we need to bind the interface with the implementation.
             */
            if (version_compare(PHP_VERSION, '8.0.0') >= 0) {
                if (null !== $value->getType()->getName() && $this->binding()->has($value->getType()->getName())) {
                    $className = $this->binding()->get($value->getType()->getName());
                    $paramsIoC[] = (is_object($className)) ? $className : new $className;
                    continue;
                }
            } else {
                if (isset($value->getClass()->name) && $this->binding()->has($value->getClass()->name)) {
                    $className = $this->binding()->get($value->getClass()->name);
                    $paramsIoC[] = (is_object($className)) ? $className : new $className;
                    continue;
                }
            }

            /*
             | If the class constructor contains arguments with default values,
             | then if no arguments are passed,
             | values will be added by default by container
             */
            if ($value->isDefaultValueAvailable() && !isset($params[$i])) {
                $paramsIoC[] = $value->getDefaultValue();
                continue;
            }

            $paramsIoC[] = $params[$i++];
        }

        return $paramsIoC;
    }
}
