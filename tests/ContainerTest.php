<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 *
 *  phpunit src/tests/ContainerTest --coverage-html src/tests/coverage-html
 */

namespace Rudra\Tests;

use Rudra\Container;
use Rudra\Interfaces\ContainerInterface;
use Rudra\Tests\Stub\ClassWithDependency;
use Rudra\Tests\Stub\ClassWithoutParameters;
use Rudra\Tests\Stub\ClassWithoutConstructor;
use Rudra\Tests\Stub\ClassWithDefaultParameters;
use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;

/**
 * Class ContainerTest
 */
class ContainerTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    protected function setUp(): void
    {
        $this->container = Container::app();
        $this->container->setBinding(ContainerInterface::class, $this->container);
    }

    /**
     * Проверяем синглтон
     */
    public function testCallSingleton(): void
    {
        $this->assertInstanceOf(Container::class, Container::app());
        $this->assertInstanceOf(Container::class, $this->container);
    }

    public function testGet(): void
    {
        $this->assertTrue(empty($this->container->get()));
    }

    public function testSetServices(): void
    {
        $this->container->setServices([
            'contracts' => [
                ContainerInterface::class => $this->container
            ],

            'services' => [
                'CWC'  => [ClassWithoutConstructor::class],
                'CWP'  => [ClassWithoutParameters::class],
                'CWDP' => [ClassWithDefaultParameters::class, ['param' => '123']],
            ]
        ]);

        $this->assertInstanceOf(ClassWithoutConstructor::class, $this->container->get('CWC'));
        $this->assertInstanceOf(ClassWithoutParameters::class, $this->container->get('CWP'));
        $this->assertInstanceOf(ClassWithDefaultParameters::class, $this->container->get('CWDP'));
    }

    public function testSetRaw(): void
    {
        $this->container->set(ContainerTest::class, $this, 'raw');
        $this->assertInstanceOf(ContainerTest::class, $this->container->get(ContainerTest::class));
    }

    public function testGetArrayHasKey(): void
    {
        $this->assertArrayHasKey(ContainerTest::class, $this->container->get());
    }

    public function testIoCClassWithoutConstructor(): void
    {
        $newClassWithoutConstructor = $this->container->new(ClassWithoutConstructor::class);
        $this->assertInstanceOf(ClassWithoutConstructor::class, $newClassWithoutConstructor);

        $this->container->set('ClassWithoutConstructor', $newClassWithoutConstructor);
        $this->assertInstanceOf(ClassWithoutConstructor::class, $this->container->get('ClassWithoutConstructor'));
    }

    public function testIoCwithoutParameters(): void
    {
        $newClassWithoutParameters = $this->container->new(ClassWithoutParameters::class);
        $this->assertInstanceOf(ClassWithoutParameters::class, $newClassWithoutParameters);

        $this->container->set('ClassWithoutParameters', $newClassWithoutParameters);
        $this->assertInstanceOf(ClassWithoutParameters::class, $this->container->get('ClassWithoutParameters'));
    }

    public function testIoCwithDefaultParameters(): void
    {
        $newClassWithDefaultParameters = $this->container->new(ClassWithDefaultParameters::class);
        $this->assertInstanceOf(ClassWithDefaultParameters::class, $newClassWithDefaultParameters);

        $this->container->set('ClassWithDefaultParameters', $newClassWithDefaultParameters);
        $this->assertInstanceOf(ClassWithDefaultParameters::class, $this->container->get('ClassWithDefaultParameters'));
    }

    public function testIoCwithDependency(): void
    {
        $newClassWithDependency = $this->container->new(ClassWithDependency::class);
        $this->assertInstanceOf(ClassWithDependency::class, $newClassWithDependency);

        $this->container->set('ClassWithDependency', $newClassWithDependency);
        $this->assertInstanceOf(ClassWithDependency::class, $this->container->get('ClassWithDependency'));
    }

    public function testHas(): void
    {
        $this->assertTrue($this->container->has(ContainerTest::class));
        $this->assertTrue($this->container->has('ClassWithoutConstructor'));
        $this->assertTrue($this->container->has('ClassWithoutParameters'));
        $this->assertTrue($this->container->has('ClassWithDefaultParameters'));
        $this->assertTrue($this->container->has('ClassWithDependency'));
        $this->assertFalse($this->container->has('SomeClass'));
    }

    public function testSetParam(): void
    {
        $param = 'value';
        $this->container->setParam('ClassWithDependency', 'param', $param);
        $this->assertEquals($param, $this->container->getParam('ClassWithDependency', 'param'));
    }

    public function testHasParam(): void
    {
        $this->assertTrue($this->container->hasParam('ClassWithDependency', 'param'));
        $this->assertNull($this->container->hasParam('SomeClass', 'param'));
    }

    public function testFailureGetParam(): void
    {
        $this->assertNull($this->container->getParam('SomeClass', 'param'));
    }

    public function testGetData(): void
    {
        $this->container->setGet(['key' => 'value']);
        $this->assertEquals('value', $this->container->getGet('key'));
        $this->assertContains('value', $this->container->getGet());
        $this->assertTrue($this->container->hasGet('key'));
        $this->assertFalse($this->container->hasGet('false'));
    }

    public function testPostData(): void
    {
        $this->container->setPost(['key' => 'value']);
        $this->assertEquals('value', $this->container->getPost('key'));
        $this->assertContains('value', $this->container->getPost());
        $this->assertTrue($this->container->hasPost('key'));
        $this->assertFalse($this->container->hasPost('false'));
    }

    public function testServerData(): void
    {
        $this->container->setServer('key', 'value');
        $this->assertEquals('value', $this->container->getServer('key'));
        $this->assertArrayHasKey('key', $this->container->getServer());
    }

    public function testSessionData(): void
    {
        $this->container->setSession('key', 'value');
        $this->container->setSession('subKey', 'value', 'subSet');
        $this->container->setSession('increment', 'value', 'increment');
        $this->assertEquals('value', $this->container->getSession('key'));
        $this->assertEquals('value', $this->container->getSession('subKey', 'subSet'));
        $this->assertEquals('value', $this->container->getSession('increment', '0'));
        $this->assertTrue($this->container->hasSession('key'));
        $this->assertTrue($this->container->hasSession('subKey', 'subSet'));
        $this->assertNull($this->container->unsetSession('key'));
        $this->assertNull($this->container->unsetSession('subKey', 'subSet'));
        $this->assertFalse($this->container->hasSession('key'));
        $this->assertFalse($this->container->hasSession('subKey', 'subSet'));
        $this->assertNull($this->container->clearSession());
    }

    public function testCookieData(): void
    {
        $this->container->setCookie('key', 'value');
        $this->assertEquals('value', $this->container->getCookie('key'));
        $this->assertTrue($this->container->hasCookie('key'));
        $this->assertFalse($this->container->hasCookie('false'));
    }

    public function testFilesData(): void
    {
        $this->container->setFiles(
            [
                'upload' => ['name' => ['img' => '41146.png']],
                'type'   => ['img' => 'image/png'],
            ]
        );

        $this->assertTrue($this->container->isUploaded('img'));
        $this->assertTrue($this->container->isFileType('img', 'image/png'));
        $this->assertEquals('41146.png', $this->container->getUpload('img', 'name'));
    }
}
