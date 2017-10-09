<?php

declare(strict_types = 1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2017, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra;

/**
 * Class ContainerResponseTrait
 *
 * @package Rudra
 */
trait ContainerResponseTrait
{

    /**
     * @param array $data
     */
    public function jsonResponse(array $data): void
    {
        header('Content-Type: application/json');
        echo $this->getJson($data);
    }

    /**
     * @param array $data
     *
     * @return string
     */
    protected function getJson(array $data): string
    {
        return json_encode($data);
    }
}
