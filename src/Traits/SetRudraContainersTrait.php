<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Traits;

use Rudra\Container\Interfaces\RudraInterface;

trait SetRudraContainersTrait
{
    private RudraInterface $rudra;

    /**
     * Takes RudraInterface as an argument
     * -----------------------------------
     * Принимает в качестве аргумента RudraInterface
     *
     * @param  RudraInterface $rudra
     */
    public function __construct(RudraInterface $rudra)
    {
        $this->rudra = $rudra;
    }

    /**
     * Gets access to the application
     * ------------------------------
     * Получает доступ к приложению
     *
     * @return RudraInterface
     */
    public function rudra(): RudraInterface
    {
        return $this->rudra;
    }
}
