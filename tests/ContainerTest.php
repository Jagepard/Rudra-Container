<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 *
 *  phpunit src/tests/ContainerTest --coverage-html src/tests/coverage-html
 */

namespace Rudra\Container\Tests;

use Rudra\Container\Application;
use Rudra\Container\Interfaces\ApplicationInterface;
use Rudra\Container\Tests\Stub\ClassWithDependency;
use Rudra\Container\Tests\Stub\ClassWithoutParameters;
use Rudra\Container\Tests\Stub\ClassWithoutConstructor;
use Rudra\Container\Tests\Stub\ClassWithDefaultParameters;
use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;

class ContainerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ApplicationInterface
     */
    protected $container;

    protected function setUp(): void
    {
        $this->container = rudra();
        $this->container->setBinding(ApplicationInterface::class, $this->container);
    }

    public function testCallSingleton(): void
    {
        $this->assertInstanceOf(Application::class, Application::app());
        $this->assertInstanceOf(Application::class, $this->container);
    }

    public function testGet(): void
    {
        $this->assertTrue(empty($this->container->get()));
    }

    public function testSetServices(): void
    {
        $this->container->setServices(
            [
                'contracts' => [
                    ApplicationInterface::class => $this->container,
                ],

                'services' => [
                    'CWC' => [ClassWithoutConstructor::class],
                    'CWP' => [ClassWithoutParameters::class],
                    'CWDP' => [ClassWithDefaultParameters::class, ['123']],
                ],
            ]
        );

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
        $this->container->set(ContainerTest::class, $this, 'raw');
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
        $this->assertEquals('Default', $newClassWithDefaultParameters->getParam());

        $newClassWithDefaultParameters = $this->container->new(ClassWithDefaultParameters::class, ['Test']);
        $this->assertEquals('Test', $newClassWithDefaultParameters->getParam());

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
        $this->container->request()->get()->set(['key' => 'value']);
        $this->assertEquals('value', $this->container->request()->get()->get('key'));
        $this->assertContains('value', $this->container->request()->get()->get());
        $this->assertTrue($this->container->request()->get()->has('key'));
        $this->assertFalse($this->container->request()->get()->has('false'));
    }

    public function testPostData(): void
    {
        $this->container->request()->post()->set(['key' => 'value']);
        $this->assertEquals('value', $this->container->request()->post()->get('key'));
        $this->assertContains('value', $this->container->request()->post()->get());
        $this->assertTrue($this->container->request()->post()->has('key'));
        $this->assertFalse($this->container->request()->post()->has('false'));
    }

    public function testServerData(): void
    {
        $this->container->request()->server()->setValue('key', 'value');
        $this->assertEquals('value', $this->container->request()->server()->get('key'));
        $this->assertArrayHasKey('key', $this->container->request()->server()->get());
    }

    public function testSessionData(): void
    {
        $this->container->session()->set('key', 'value');
        $this->container->session()->set('subKey', 'value', 'subSet');
        $this->container->session()->set('increment', 'value', 'increment');
        $this->assertEquals('value', $this->container->session()->get('key'));
        $this->assertEquals('value', $this->container->session()->get('subKey', 'subSet'));
        $this->assertEquals('value', $this->container->session()->get('increment', '0'));
        $this->assertTrue($this->container->session()->has('key'));
        $this->assertTrue($this->container->session()->has('subKey', 'subSet'));
        $this->assertNull($this->container->session()->unset('key'));
        $this->assertNull($this->container->session()->unset('subKey', 'subSet'));
        $this->assertFalse($this->container->session()->has('key'));
        $this->assertFalse($this->container->session()->has('subKey', 'subSet'));
        $this->assertNull($this->container->session()->clear());
    }

    public function testCookieData(): void
    {
        $this->container->cookie()->set('key', 'value');
        $this->assertEquals('value', $this->container->cookie()->get('key'));
        $this->assertTrue($this->container->cookie()->has('key'));
        $this->assertFalse($this->container->cookie()->has('false'));
    }

    public function testFilesData(): void
    {
        $this->container->request()->files()->set(
            [
                'upload' => ['name' => ['img' => '41146.png']],
                'type' => ['img' => 'image/png'],
            ]
        );

        $this->assertTrue($this->container->request()->files()->isLoaded('img'));
        $this->assertTrue($this->container->request()->files()->isFileType('img', 'image/png'));
        $this->assertEquals('41146.png', $this->container->request()->files()->getLoaded('img', 'name'));
    }
}
