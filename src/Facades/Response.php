<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Container\Facades;

use Rudra\Container\Traits\FacadeTrait;

/**
 * @method static json(array $data)
 *
 * @see \Rudra\Container\Response
 */
final class Response
{
    use FacadeTrait;
}
