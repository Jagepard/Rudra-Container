<?php declare(strict_types=1);

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
 */

namespace Rudra\Container\Tests\Stub;

use stdClass;

class ClassWithDefaultParameters
{
    protected string $param;
    protected stdClass $std;

    public function __construct(stdClass $std, string $param = "Default")
    {
        $this->param = $param;
        $this->std   = $std;
    }

    public function getParam(): string
    {
        return $this->param;
    }

    public function getStd(): stdClass
    {
        return $this->std;
    }
}
