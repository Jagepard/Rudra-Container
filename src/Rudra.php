<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Rudra\Container\Abstracts\{AbstractRudra,
    RudraInterface,
    ContainerInterface,
    AbstractRequest,
    AbstractResponse};
use Rudra\Container\Traits\{InstantiationsTrait, PublicApplicationTrait};

class Rudra extends AbstractRudra implements RudraInterface, ContainerInterface
{
    use InstantiationsTrait;
    use PublicApplicationTrait;

    public static ?AbstractRudra $rudra = null;
    private array $data = [];

    protected function _setServices(array $services): void
    {
        ($this->_has("binding")) ?: $this->_set(["binding", new Container($services["contracts"])]);
        ($this->_has("services")) ?: $this->_set(["services", new Container($services["services"])]);
        ($this->_has("config")) ?: $this->_set(["config", new Container($services["config"])]);
    }

    protected function _binding(): ContainerInterface
    {
        if ($this->_has("binding")) return $this->_get("binding");
        throw new \InvalidArgumentException("Service not preinstalled");
    }

    protected function _services(): ContainerInterface
    {
        if ($this->_has("services")) return $this->_get("services");
        throw new \InvalidArgumentException("Service not preinstalled");
    }
    
    protected function _config(): ContainerInterface
    {
        if ($this->_has("config")) return $this->_get("config");
        throw new \InvalidArgumentException("Service not preinstalled");
    }

    protected function _request(): AbstractRequest
    {
        return $this->containerize(Request::class);
    }

    protected function _response(): AbstractResponse
    {
        return $this->containerize(Response::class);
    }

    protected function _cookie(): Cookie
    {
        return $this->containerize(Cookie::class);
    }

    protected function _session(): Session
    {
        return $this->containerize(Session::class);
    }

    /*
     | Creates an object without adding to the container
     */
    protected function _new($object, $params = null)
    {
        $reflection = new \ReflectionClass($object);
        $constructor = $reflection->getConstructor();

        if ($constructor && $constructor->getNumberOfParameters()) {
            $paramsIoC = $this->getParamsIoC($constructor, $params);

            return $reflection->newInstanceArgs($paramsIoC);
        }

        return new $object();
    }

    public static function run(): AbstractRudra
    {
        if (!static::$rudra instanceof static) {
            static::$rudra = new static();
        }

        return static::$rudra;
    }

    protected function _get(string $key = null)
    {
        if (isset($key) && !$this->_has($key)) {
            if (!$this->_services()->has($key)) {
                throw new \InvalidArgumentException("Service is not installed");
            }

            $this->_set([$key, $this->_services()->get($key)]);
        }

        return empty($key) ? $this->data : $this->data[$key];
    }

    protected function _set(array $data): void
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

    protected function _has(string $key): bool
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
            if (isset($value->getClass()->name) && $this->_binding()->has($value->getClass()->name)) {
                $className = $this->_binding()->get($value->getClass()->name);
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
}
