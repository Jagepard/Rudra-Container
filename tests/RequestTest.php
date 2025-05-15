<?php declare(strict_types=1);

namespace Rudra\Container\Tests;

use Rudra\Container\Request;
use Rudra\Container\Container;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    private Request $request;

    protected function setUp(): void
    {
        // Обнуляем глобальные массивы, чтобы не мешали
        $_GET = ['test_get' => 'value'];
        $_POST = ['test_post' => 'value'];
        $_SERVER = ['test_server' => 'value'];
        $_FILES = ['test_file' => ['name' => 'file.txt']];

        $this->request = new Request();
    }

    public function testGetReturnsContainer(): void
    {
        $container = $this->request->get();
        $this->assertInstanceOf(Container::class, $container);
        $this->assertSame($container, $this->request->get()); // Ленивая инициализация
        $this->assertEquals($_GET['test_get'], $container->get('test_get'));
    }

    public function testPostReturnsContainer(): void
    {
        $container = $this->request->post();
        $this->assertInstanceOf(Container::class, $container);
        $this->assertSame($container, $this->request->post());
        $this->assertEquals($_POST['test_post'], $container->get('test_post'));
    }

    public function testPutReturnsEmptyContainerByDefault(): void
    {
        $container = $this->request->put();
        $this->assertInstanceOf(Container::class, $container);
        $this->assertSame($container, $this->request->put());
        $this->assertEmpty($container->all());
    }

    public function testServerReturnsContainer(): void
    {
        $container = $this->request->server();
        $this->assertInstanceOf(Container::class, $container);
        $this->assertSame($container, $this->request->server());
        $this->assertEquals($_SERVER['test_server'], $container->get('test_server'));
    }

    public function testFilesReturnsContainer(): void
    {
        $container = $this->request->files();
    
        $this->assertInstanceOf(Container::class, $container);
        $this->assertSame($container, $this->request->files());

        $fileData = $container->get('test_file');
    
        $this->assertIsArray($fileData);
        $this->assertEquals('file.txt', $fileData['name']);
    }
}
