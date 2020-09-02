<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Traits;

trait ContainerTrait
{
    public function db()
    {
        return rudra()->di()->get("db");
    }

    public function validation()
    {
        return rudra()->di()->get("validation");
    }

    public function redirect(string $target = null)
    {
        return isset($target) ? rudra()->di()->get("redirect")->run($target) : rudra()->di()->get("redirect");
    }

    public function post($key = null)
    {
        return rudra()->request()->post()->get($key);
    }

    public function setSession(string $key, string $value): void
    {
        rudra()->session()->set([$key, $value]);
    }

    public function unsetSession(string $key, string $subKey = null)
    {
        rudra()->session()->unset($key, $subKey);
    }
}
