<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Abstracts\{AbstractApplication, AbstractContainer, AbstractRequest, AbstractResponse};
use Rudra\Container\Traits\InstantiationsTrait;

class Rudra extends AbstractApplication
{
    use InstantiationsTrait;

    public static ?AbstractApplication $rudra = null;
    private array $data = [];

    public function __construct()
    {
    }

    protected function setServices(array $services): void
    {
        ($this->has("binding")) ?: $this->set(["binding", new Container($services["contracts"])]);
        ($this->has("services")) ?: $this->set(["services", new Container($services["services"])]);
        ($this->has("config")) ?: $this->set(["config", new Container($services["config"])]);
    }

    protected function cookie(): Cookie
    {
        return $this->get("cookie");
    }

    protected function session(): Session
    {
        return $this->get("session");
    }

    protected function binding(): AbstractContainer
    {
        return $this->get("binding");
    }

    protected function services(): AbstractContainer
    {
        return $this->get("services");
    }
    
    protected function config(): AbstractContainer
    {
        return $this->get("config");
    }

    protected function request(): AbstractRequest
    {
        return $this->get("request");
    }

    protected function response(): AbstractResponse
    {
        return $this->get("response");
    }

    /*
     | Creates an object without adding to the container
     */
    protected function new($object, $params = null)
    {
        $reflection = new \ReflectionClass($object);
        $constructor = $reflection->getConstructor();

        if ($constructor && $constructor->getNumberOfParameters()) {
            $paramsIoC = $this->getParamsIoC($constructor, $params);

            return $reflection->newInstanceArgs($paramsIoC);
        }

        return new $object();
    }

    public static function run(): AbstractApplication
    {
        if (!static::$rudra instanceof static) {
            static::$rudra = new static();
        }

        return static::$rudra;
    }

    public function get(string $key = null)
    {
        if (isset($key) && !$this->has($key)) {
            if (!$this->services()->has($key)) {
                throw new \InvalidArgumentException("Service is not installed");
            }

            $this->set([$key, $this->services()->get($key)]);
        }

        return empty($key) ? $this->data : $this->data[$key];
    }

    public function set(array $data): void
    {
        list($key, $object) = $data;

        if (is_array($object)) {
            if (array_key_exists(1, $object) && !is_object($object[0])) {
                $this->iOc($key, $object[0], $object[1]);
                return;
            }

            $this->setObject($object[0], $key);
            return;
        }

        $this->setObject($object, $key);
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }

    private function setObject($object, $key): void
    {
        (is_object($object)) ? $this->mergeData($key, $object) : $this->iOc($key, $object);
    }

    private function mergeData(string $key, $object)
    {
        $this->data = array_merge([$key => $object], $this->data);
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
            if (isset($value->getClass()->name) && $this->binding()->has($value->getClass()->name)) {
                $className = $this->binding()->get($value->getClass()->name);
                $paramsIoC[] = (is_object($className)) ? $className : new $className;
                continue;
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

    public function __call($method, $parameters) {
        return $this->$method(...$parameters);
    }

    public static function __callStatic($method, $parameters)
    {
        return Rudra::run()->$method(...$parameters);
    }
}
