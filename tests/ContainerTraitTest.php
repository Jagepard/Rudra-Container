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

use Rudra\Interfaces\ContainerInterface;
use Rudra\Tests\Stub\ClassWithoutParameters;
use Rudra\Tests\Stub\ClassWithContainerTrait;
use Rudra\Tests\Stub\ClassWithoutConstructor;
use Rudra\Tests\Stub\ClassWithDefaultParameters;
use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;

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
        $this->container = rudra();
        $this->container()->setBinding(ContainerInterface::class, $this->container());

        $app = [
            'contracts' => [
                ContainerInterface::class => $this->container()
            ],

            'services' => [
                'validation' => [ClassWithoutConstructor::class],
                'redirect'   => [ClassWithoutParameters::class],
                'db'         => [ClassWithDefaultParameters::class, ['123']],
            ]
        ];

        $this->container()->setServices($app);

        $this->stub = new ClassWithContainerTrait($this->container());
    }

    public function testValidation(): void
    {
        $this->assertInstanceOf(ClassWithoutConstructor::class, $this->stub()->validation());
    }

    public function testRedirect(): void
    {
        $this->assertInstanceOf(ClassWithoutParameters::class, $this->stub()->redirect());
    }

    public function testDb(): void
    {
        $this->assertInstanceOf(ClassWithDefaultParameters::class, $this->stub()->db());
    }

    public function testNew(): void
    {
        $newClassWithoutConstructor = $this->stub()->new(ClassWithoutConstructor::class);
        $this->assertInstanceOf(ClassWithoutConstructor::class, $newClassWithoutConstructor);
    }

    public function testSetPagination(): void
    {
        $this->getMockBuilder('Rudra\Pagination')->getMock();
        $this->stub()->setPagination(['id' => 1], 1, 1);
        $this->assertInstanceOf('Rudra\Pagination', $this->stub()->pagination());
    }

    public function testPost(): void
    {
        $this->container()->setPost(['key' => 'value']);
        $this->assertEquals('value', $this->stub()->post('key'));
    }

    public function testPut(): void
    {
        $this->container()->setPut(['key' => 'value']);
        $this->assertTrue($this->stub()->container()->hasPut('key'));
        $this->assertEquals('value', $this->stub()->container()->getPut('key'));
    }

    public function testPatch(): void
    {
        $this->container()->setPatch(['key' => 'value']);
        $this->assertTrue($this->stub()->container()->hasPatch('key'));
        $this->assertEquals('value', $this->stub()->container()->getPatch('key'));
    }

    public function testDelete(): void
    {
        $this->container()->setDelete(['key' => 'value']);
        $this->assertTrue($this->stub()->container()->hasDelete('key'));
        $this->assertEquals('value', $this->stub()->container()->getDelete('key'));
    }

    public function testSessionData(): void
    {
        $this->stub()->setSession('key', 'value');
        $this->stub()->setSession('subKey', 'value', 'subSet');
        $this->stub()->setSession('increment', 'value', 'increment');
        $this->assertEquals('value', $this->container()->getSession('key'));
        $this->assertEquals('value', $this->container()->getSession('subKey', 'subSet'));
        $this->assertEquals('value', $this->container()->getSession('increment', '0'));
        $this->assertNull($this->stub()->unsetSession('key'));
        $this->assertNull($this->stub()->unsetSession('subKey', 'subSet'));
        $this->assertFalse($this->container()->hasSession('key'));
        $this->assertFalse($this->container()->hasSession('subKey', 'subSet'));
    }

    public function testConfig(): void
    {
        $this->container()->setConfig(['key' => ['subKey' => 'value']]);
        $this->container()->addConfig(['addKey', 'subKey'] , 'value');
        $this->container()->addConfig('stringKey' , 'value');

        $this->assertTrue(is_array($this->container()->getConfig()));
        $this->assertInternalType('array', config('key'));
        $this->assertEquals('value', config('key', 'subKey'));
        $this->assertEquals('value', config('addKey', 'subKey'));
        $this->assertEquals('value', config('stringKey'));
    }

    /**
     * @runInSeparateProcess
     */
    public function testJsonResponse(): void
    {
        $data = ['key' => ['subKey' => 'value']];

        ob_start();
        $this->container()->jsonResponse($data);
        $json = ob_get_clean();

        $this->assertEquals(json_encode($data), $json);
    }

    /**
     * @return ClassWithContainerTrait
     */
    public function stub(): ClassWithContainerTrait
    {
        return $this->stub;
    }

    /**
     * @return ContainerInterface
     */
    public function container(): ContainerInterface
    {
        return $this->container;
    }
}
