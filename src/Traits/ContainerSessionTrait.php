<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2016, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra\Container\Traits;

/**
 * Trait ContainerSessionTrait
 * @package Rudra\Traits
 */
trait ContainerSessionTrait
{

    /**
     * @param string      $key
     * @param string|null $subKey
     * @return mixed
     */
    public function getSession(string $key, string $subKey = null)
    {
        return ($subKey === null) ? $_SESSION[$key] : $_SESSION[$key][$subKey];
    }

    /**
     * @param string      $key
     * @param             $value
     * @param string|null $subKey
     */
    public function setSession(string $key, $value, string $subKey = null): void
    {
        if (empty($subKey)) {
            $_SESSION[$key] = $value;
        } else {
            if ($subKey == 'increment') {
                $_SESSION[$key][] = $value;
            } else {
                $_SESSION[$key][$subKey] = $value;
            }
        }
    }

    /**
     * @param string      $key
     * @param string|null $subKey
     * @return bool
     */
    public function hasSession(string $key, string $subKey = null): bool
    {
        return empty($subKey) ? isset($_SESSION[$key]) : isset($_SESSION[$key][$subKey]);
    }

    /**
     * @param string      $key
     * @param string|null $subKey
     */
    public function unsetSession(string $key, string $subKey = null): void
    {
        if (empty($subKey)) {
            unset($_SESSION[$key]);
        } else {
            unset($_SESSION[$key][$subKey]);
        }
    }

    /**
     * @codeCoverageIgnore
     */
    public function startSession(): void
    {
        session_start();
    }

    /**
     * @codeCoverageIgnore
     */
    public function stopSession(): void
    {
        session_destroy();
    }

    public function clearSession(): void
    {
        $_SESSION = [];
    }
}
