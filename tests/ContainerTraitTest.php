<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 *
 *  phpunit src/tests/ContainerTraitTest --coverage-html src/tests/coverage-html
 */

namespace Rudra\Container\Tests;

use Rudra\Container\Interfaces\ApplicationInterface;

use Rudra\Container\Request;
use Rudra\Container\Tests\Stub\ClassWithoutParameters;
use Rudra\Container\Tests\Stub\ClassWithContainerTrait;
use Rudra\Container\Tests\Stub\ClassWithoutConstructor;
use Rudra\Container\Tests\Stub\ClassWithDefaultParameters;
use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;

class ContainerTraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ClassWithContainerTrait
     */
    private $stub;
    /**
     * @var ApplicationInterface
     */
    private $container;
    /**
     * @var Request
     */
    private $request;

    /**
     * @var string
     */
    protected $stubNamespace = 'Rudra\\Container\\Tests\\Stub\\';

    protected function setUp(): void
    {
        $this->container = rudra();
        $this->container->setBinding(ApplicationInterface::class, $this->container);
        $this->request = $this->container->request();

        $app = [
            'contracts' => [
                ApplicationInterface::class => $this->container,
            ],

            'services' => [
                'validation' => [ClassWithoutConstructor::class],
                'redirect' => [ClassWithoutParameters::class],
                'db' => [ClassWithDefaultParameters::class, ['123']],
            ],
        ];

        $this->container->setServices($app);
        $this->stub = new ClassWithContainerTrait($this->container);
    }

    public function testValidation(): void
    {
        $this->assertInstanceOf(ClassWithoutConstructor::class, $this->stub->validation());
    }

    public function testRedirect(): void
    {
        $this->assertInstanceOf(ClassWithoutParameters::class, $this->stub->redirect());
    }

    public function testDb(): void
    {
        $this->assertInstanceOf(ClassWithDefaultParameters::class, $this->stub->db());
    }

    public function testNew(): void
    {
        $newClassWithoutConstructor = $this->stub->new(ClassWithoutConstructor::class);
        $this->assertInstanceOf(ClassWithoutConstructor::class, $newClassWithoutConstructor);
    }

    public function testSetPagination(): void
    {
        $this->getMockBuilder('Rudra\Pagination')->getMock();
        $this->stub->setPagination(['id' => 1], 1, 1);
        $this->assertInstanceOf('Rudra\Pagination', $this->stub->pagination());
    }

    public function testPost(): void
    {
        $this->request->post()->set(['key' => 'value']);
        $this->assertEquals('value', $this->request->post()->get('key'));
    }

    public function testPut(): void
    {
        $this->request->put()->set(['key' => 'value']);
        $this->assertTrue($this->request->put()->has('key'));
        $this->assertEquals('value', $this->request->put()->get('key'));
    }

    public function testPatch(): void
    {
        $this->request->patch()->set(['key' => 'value']);
        $this->assertTrue($this->request->patch()->has('key'));
        $this->assertEquals('value', $this->request->patch()->get('key'));
    }

    public function testDelete(): void
    {
        $this->request->delete()->set(['key' => 'value']);
        $this->assertTrue($this->request->delete()->has('key'));
        $this->assertEquals('value', $this->request->delete()->get('key'));
    }

    public function testSessionData(): void
    {
        $this->stub->setSession('key', 'value');
        $this->stub->setSession('subKey', 'value', 'subSet');
        $this->stub->setSession('increment', 'value', 'increment');
        $this->assertEquals('value', $this->container->session()->get('key'));
        $this->assertEquals('value', $this->container->session()->get('subKey', 'subSet'));
        $this->assertEquals('value', $this->container->session()->get('increment', '0'));
        $this->assertNull($this->container->session()->unset('key'));
        $this->assertNull($this->container->session()->unset('subKey', 'subSet'));
        $this->assertFalse($this->container->session()->has('key'));
        $this->assertFalse($this->container->session()->has('subKey', 'subSet'));
    }

    public function testConfig(): void
    {
        $this->container->config()->set(['key' => ['subKey' => 'value']]);
        $this->container->config()->add('addKey', ['subKey' => 'value']);
        $this->container->config()->add('stringKey', 'value');

        $this->assertTrue(is_array($this->container->config()->get()));
        $this->assertIsArray(config('key'));
        $this->assertEquals('value', config('key')['subKey']);
        $this->assertEquals(['subKey' => 'value'], config('addKey'));
        $this->assertEquals('value', config('stringKey'));
    }

    /**
     * @runInSeparateProcess
     */
    public function testJsonResponse(): void
    {
        $data = ['key' => ['subKey' => 'value']];

        ob_start();
        $this->container->response()->jsonResponse($data);
        $json = ob_get_clean();

        $this->assertEquals(json_encode($data), $json);
    }
}
