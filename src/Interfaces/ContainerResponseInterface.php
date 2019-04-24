<?php

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra\Interfaces;

interface ContainerResponseInterface
{
    /**
     * @codeCoverageIgnore
     * @param array $data
     */
    public function jsonResponse(array $data): void;
}
