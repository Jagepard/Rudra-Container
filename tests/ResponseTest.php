<?php declare(strict_types=1);

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
 */

namespace Rudra\Container\Tests;

use Rudra\Container\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    private Response $response;

    protected function setUp(): void
    {
        $this->response = new Response();
    }

    public function testGetJsonEncodesDataCorrectly(): void
    {
        $data = ['name' => 'John', 'age' => 30];
        $expectedJson = '{"name":"John","age":30}';

        $method = new \ReflectionMethod(Response::class, 'getJson');
        $method->setAccessible(true);

        $result = $method->invoke($this->response, $data);

        $this->assertEquals($expectedJson, $result);
    }

    public function testJsonOutputIsCorrect(): void
    {
        ob_start();
        $this->response->json(['status' => 'success']);
        $output = ob_get_clean();

        $this->assertEquals('{"status":"success"}', $output);
    }

    public function testJsonSetsCorrectContentTypeHeader(): void
    {
        $this->expectOutputString('{"status":"success"}');
        $this->response->json(['status' => 'success']);

        // Verify that the header was set
        $headers = xdebug_get_headers();
        $this->assertContains('Content-Type: application/json', $headers);
    }
}
