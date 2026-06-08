<?php declare(strict_types=1);

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
 */

namespace Rudra\Container\Traits;

use Rudra\Exceptions\LogicException;
use Rudra\Container\Interfaces\RudraInterface;

trait SetRudraContainersTrait
{
    public function __construct(private RudraInterface $rudra) {}

    public function rudra(): RudraInterface
    {
        if (!isset($this->rudra)) {
            throw new LogicException('Rudra instance not initialized. Did you override __construct()?');
        }

        return $this->rudra;
    }
}
