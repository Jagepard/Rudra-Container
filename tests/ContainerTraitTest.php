<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 *
 *  phpunit src/tests/ContainerTraitTest --coverage-html src/tests/coverage-html
 */

namespace Rudra\Tests;

use Rudra\Container;
use Rudra\Interfaces\ContainerInterface;
use Rudra\Tests\Stub\ClassWithContainerTrait;
use Rudra\Tests\Stub\ClassWithDefaultParameters;
use Rudra\Tests\Stub\ClassWithoutConstructor;
use Rudra\Tests\Stub\ClassWithoutParameters;
use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;

/**
 * Class ContainerTraitTest
 */
class ContainerTraitTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var ClassWithContainerTrait
     */
    protected $stub;
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var string
     */
    protected $stubNamespace = 'Rudra\\Tests\\Stub\\';

    protected function setUp(): void
    {
        $this->container = Container::app();
        $this->container->setBinding(ContainerInterface::class, $this->container);

        $app = [
            'contracts' => [
                ContainerInterface::class => $this->container
            ],

            'services' => [
                'validation' => [ClassWithoutConstructor::class],
                'redirect'   => [ClassWithoutParameters::class],
                'db'         => [ClassWithDefaultParameters::class, ['param' => '123']],
            ]
        ];

        $this->container->setServices($app);

        $this->stub = new ClassWithContainerTrait($this->container);
    }

    public function testValidation(): void
    {
        $this->assertInstanceOf(ClassWithoutConstructor::class, $this->getStub()->validation());
    }

    public function testRedirect(): void
    {
        $this->assertInstanceOf(ClassWithoutParameters::class, $this->getStub()->redirect());
    }

    public function testDb(): void
    {
        $this->assertInstanceOf(ClassWithDefaultParameters::class, $this->getStub()->db());
    }

    public function testNew(): void
    {
        $newClassWithoutConstructor = $this->getStub()->new(ClassWithoutConstructor::class);
        $this->assertInstanceOf(ClassWithoutConstructor::class, $newClassWithoutConstructor);
    }

    public function testSetPagination(): void
    {
        $this->getMockBuilder('Rudra\Pagination')->getMock();
        $this->getStub()->setPagination(['id' => 1]);
        $this->assertInstanceOf('Rudra\Pagination', $this->getStub()->pagination());
    }

    public function testPost(): void
    {
        $this->container->setPost(['key' => 'value']);
        $this->assertEquals('value', $this->getStub()->post('key'));
    }

    public function testPut(): void
    {
        $this->container->setPut(['key' => 'value']);
        $this->assertTrue($this->getStub()->container()->hasPut('key'));
        $this->assertEquals('value', $this->getStub()->container()->getPut('key'));
    }

    public function testPatch(): void
    {
        $this->container->setPatch(['key' => 'value']);
        $this->assertTrue($this->getStub()->container()->hasPatch('key'));
        $this->assertEquals('value', $this->getStub()->container()->getPatch('key'));
    }

    public function testDelete(): void
    {
        $this->container->setDelete(['key' => 'value']);
        $this->assertTrue($this->getStub()->container()->hasDelete('key'));
        $this->assertEquals('value', $this->getStub()->container()->getDelete('key'));
    }

    public function testSessionData(): void
    {
        $this->getStub()->setSession('key', 'value');
        $this->getStub()->setSession('subKey', 'value', 'subSet');
        $this->getStub()->setSession('increment', 'value', 'increment');
        $this->assertEquals('value', $this->container->getSession('key'));
        $this->assertEquals('value', $this->container->getSession('subKey', 'subSet'));
        $this->assertEquals('value', $this->container->getSession('increment', '0'));
        $this->assertNull($this->getStub()->unsetSession('key'));
        $this->assertNull($this->getStub()->unsetSession('subKey', 'subSet'));
        $this->assertFalse($this->container->hasSession('key'));
        $this->assertFalse($this->container->hasSession('subKey', 'subSet'));
    }

    public function testConfig(): void
    {
        $this->container->setConfig(['key' => ['subKey' => 'value']]);

        $this->assertInternalType('array', $this->container->config('key'));
        $this->assertEquals('value', $this->container->config('key', 'subKey'));
    }

    /**
     * @runInSeparateProcess
     */
    public function testJsonResponse(): void
    {
        $data = ['key' => ['subKey' => 'value']];

        ob_start();
        $this->container->jsonResponse($data);
        $json = ob_get_clean();

        $this->assertEquals(json_encode($data), $json);
    }

    /**
     * @return ClassWithContainerTrait
     */
    public function getStub(): ClassWithContainerTrait
    {
        return $this->stub;
    }
}
