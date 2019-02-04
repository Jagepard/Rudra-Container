<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra\Traits;

/**
 * Trait ContainerResponseTrait
 * @package Rudra\Traits
 */
trait ContainerResponseTrait
{

    /**
     * @codeCoverageIgnore
     * @param array $data
     */
    public function jsonResponse(array $data): void
    {
        header('Content-Type: application/json');
        echo $this->getJson($data);
    }

    /**
     * @param array $data
     * @return string
     */
    private function getJson(array $data): string
    {
        return json_encode($data);
    }
}
