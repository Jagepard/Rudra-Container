<?php declare(strict_types=1);

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
 */

namespace Rudra\Container;

use Rudra\Container\Interfaces\ResponseInterface;

class Response implements ResponseInterface
{
    /**
     * @param  array $data
     * @return void
     */
    public function json(array $data): void
    {
        header("Content-Type: application/json");
        print $this->getJson($data);
    }

    /**
     * @param  array  $data
     * @return string
     */
    private function getJson(array $data): string
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
