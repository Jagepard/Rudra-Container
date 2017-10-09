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
     *
     * @return string
     */
    public function jsonResponse(array $data): string
    {
        header('Content-Type: application/json');

        return json_encode($data);
    }
}
