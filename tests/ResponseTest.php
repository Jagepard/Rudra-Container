<?php declare(strict_types=1);

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
        $data = ['name' => 'Иван', 'age' => 30];
        $expectedJson = '{"name":"Иван","age":30}';

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

        // Проверяем, что заголовок был установлен
        $headers = xdebug_get_headers();
        $this->assertContains('Content-Type: application/json', $headers);
    }
}
