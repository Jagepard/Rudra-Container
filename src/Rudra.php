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
     * Creates a container to associate interfaces with implementations
     * ----------------------------------------------------------------
     * Создает контейнер для связи интерфейсов с реализациями
     * 
     * @param  array              $contracts
     * @return ContainerInterface
     */
    public function binding(array $contracts = []): ContainerInterface
    {
        return $this->containerize("binding", Container::class, $contracts);
    }

    /**
     * Creates a container with a list of services
     * -------------------------------------------
     * Создает контейнер со списком серверов
     * 
     * @param  array              $services
     * @return ContainerInterface
     */
    public function serviceList(array $services = []): ContainerInterface
    {
        return $this->containerize("services", Container::class, $services);
    }
    
    /**
     * Creates a configuration container
     * ---------------------------------
     * Создает контейнер конфигураций
     * 
     * @param  array              $config
     * @return ContainerInterface
     */
    public function config(array $config = []): ContainerInterface
    {
        return $this->containerize("config", Container::class, $config);
    }

    /**
     * Creates a common data container
     * ---------------------------------
     * Создает общий контейнер данных
     * 
     * @param  array              $data
     * @return ContainerInterface
     */
    public function data(array $data = []): ContainerInterface
    {
        return $this->containerize("data", Container::class, $data);
    }
    
    /**
     * Initializes the service for the HTTP / 1.1 Common Method Kit
     * -----------------------------------------------
     * Инициализирует сервис для HTTP/1.1 Common Method Kit
     * 
     * @return RequestInterface
     */
    public function request(): RequestInterface
    {
        return $this->init(Request::class);
    }

    /**
     * Initializes the service for different types of responses
     * ------------------------------------------------
     * Инициализирует сервис для разных типов ответов
     * 
     * @return ResponseInterface
     */
    public function response(): ResponseInterface
    {
        return $this->init(Response::class);
    }

    /**
     * Initializes the cookie service
     * -------------------------------------------
     * Инициализирует сервис для работы с cookie
     * 
     * @return Cookie
     */
    public function cookie(): Cookie
    {
        return $this->init(Cookie::class);
    }

    /**
     * Initializes the service for working with sessions
     * -------------------------------------------------
     * Инициализирует сервис для работы с сессиями
     * 
     * @return Session
     */
    public function session(): Session
    {
        return $this->init(Session::class);
    }

    /**
     * Creates an object without adding to the container
     * -------------------------------------------------
     * Создает объект без добавления в контейнер
     * 
     * @param  string     $object
     * @param  array|null $params
     * @return object
     */
    public function new(string $object, ?array $params = null): object
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
     * Creates the main application singleton
     * --------------------------------------
     * Создает основной синглтон приложения
     * 
     * @return RudraInterface
     */
    public static function run(): RudraInterface
    {
        if (!static::$rudra instanceof static) {
            static::$rudra = new static();
        }

        return static::$rudra;
    }

    /**
     * Gets a service by key, or an array of services if no key is specified
     * ---------------------------------------------------------------------
     * Получает сервис по ключу или массив сервисов, если ключ не указан
     * 
     * @param  string|null $key
     * @return void
     */
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

    /**
     * Adds a service to an application
     * --------------------------------
     * Добавляет сервис в приложение
     * 
     * @param  array $data
     * @return void
     */
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

    /**
     * Checks for the existence of a service
     * -------------------------------------
     * Проверяет наличие сервиса
     * 
     * @param  string  $key
     * @return boolean
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->services);
    }

    /**
     * Sets an object
     * --------------
     * Устанавливает объект
     *
     * @param  string        $key
     * @param  string|object $object
     * @return void
     */
    private function setObject(string $key, string|object $object): void
    {
        (is_object($object)) ? $this->mergeData($key, $object) : $this->iOc($key, $object);
    }

    /**
     * Combines data
     * -------------
     * Объединяет данные
     *
     * @param  string $key
     * @param  object $object
     * @return void
     */
    private function mergeData(string $key, object $object): void
    {
        $this->services = array_merge([$key => $object], $this->services);
    }


    /**
     * Creates an object using inversion of control
     * --------------------------------------------
     * Создает объект при помощи инверсии контроля
     *
     * @param  string     $key
     * @param  string     $object
     * @param  array|null $params
     * @return void
     */
    private function iOc(string $key, string $object, ?array $params = null): void
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

    /**
     * Gets parameters using inversion of control
     * ------------------------------------------
     * Получает параметры при помощи инверсии контроля
     *
     * @param  \ReflectionMethod $constructor
     * @param  array             $params
     * @return array
     */
    private function getParamsIoC(\ReflectionMethod $constructor, ?array $params): array
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
