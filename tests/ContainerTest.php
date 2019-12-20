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

use Rudra\Container\Request;
use Rudra\Container\Container;
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
    protected $application;

    protected function setUp(): void
    {
        $this->application = rudra();
        $this->application->binding()->set([ApplicationInterface::class, $this->application]);
    }

    public function testCallSingleton(): void
    {
        $this->assertInstanceOf(Application::class, Application::run());
        $this->assertInstanceOf(Application::class, $this->application);
    }

    public function testInstances()
    {
        $this->assertInstanceOf(Request::class, Application::run()->request());
        $this->assertInstanceOf(Container::class, Application::run()->objects());
        $this->assertInstanceOf(Container::class, Application::run()->binding());
    }

    public function testGet(): void
    {
        $this->assertTrue(empty($this->application->objects()->get()));
    }

    public function testSetServices(): void
    {
        $this->application->setServices(
            [
                'contracts' => [
                    ApplicationInterface::class => $this->application,
                ],

                'services' => [
                    'CWC' => ClassWithoutConstructor::class,
                    'CWP' => ClassWithoutParameters::class,
                    'CWDP' => [ClassWithDefaultParameters::class, ['123']],
                ],
            ]
        );

        $this->assertInstanceOf(ClassWithoutConstructor::class, $this->application->objects()->get('CWC'));
        $this->assertInstanceOf(ClassWithoutParameters::class, $this->application->objects()->get('CWP'));
        $this->assertInstanceOf(ClassWithDefaultParameters::class, $this->application->objects()->get('CWDP'));
    }

    public function testSetRaw(): void
    {
        $this->application->objects()->set([ContainerTest::class, [$this, 'raw']]);
        $this->assertInstanceOf(ContainerTest::class, $this->application->objects()->get(ContainerTest::class));
    }

    public function testGetArrayHasKey(): void
    {
        $this->application->objects()->set([ContainerTest::class, [$this, 'raw']]);
        $this->assertArrayHasKey(ContainerTest::class, $this->application->objects()->get());
    }

    public function testIoCClassWithoutConstructor(): void
    {
        $newClassWithoutConstructor = $this->application->objects()->new(ClassWithoutConstructor::class);
        $this->assertInstanceOf(ClassWithoutConstructor::class, $newClassWithoutConstructor);

        $this->application->objects()->set(['ClassWithoutConstructor', $newClassWithoutConstructor]);
        $this->assertInstanceOf(ClassWithoutConstructor::class, $this->application->objects()->get('ClassWithoutConstructor'));
    }

    public function testIoCwithoutParameters(): void
    {
        $newClassWithoutParameters = $this->application->objects()->new(ClassWithoutParameters::class);
        $this->assertInstanceOf(ClassWithoutParameters::class, $newClassWithoutParameters);

        $this->application->objects()->set(['ClassWithoutParameters', $newClassWithoutParameters]);
        $this->assertInstanceOf(ClassWithoutParameters::class, $this->application->objects()->get('ClassWithoutParameters'));
    }

    public function testIoCwithDefaultParameters(): void
    {
        $newClassWithDefaultParameters = $this->application->objects()->new(ClassWithDefaultParameters::class);
        $this->assertEquals('Default', $newClassWithDefaultParameters->getParam());

        $newClassWithDefaultParameters = $this->application->objects()->new(ClassWithDefaultParameters::class, ['Test']);
        $this->assertEquals('Test', $newClassWithDefaultParameters->getParam());

        $this->application->objects()->set(['ClassWithDefaultParameters', $newClassWithDefaultParameters]);
        $this->assertInstanceOf(ClassWithDefaultParameters::class, $this->application->objects()->get('ClassWithDefaultParameters'));
    }

    public function testIoCwithDependency(): void
    {
        $newClassWithDependency = $this->application->objects()->new(ClassWithDependency::class);
        $this->assertInstanceOf(ClassWithDependency::class, $newClassWithDependency);

        $this->application->objects()->set(['ClassWithDependency', $newClassWithDependency]);
        $this->assertInstanceOf(ClassWithDependency::class, $this->application->objects()->get('ClassWithDependency'));
    }

    public function testHas(): void
    {
        $this->assertTrue($this->application->objects()->has(ContainerTest::class));
        $this->assertTrue($this->application->objects()->has('ClassWithoutConstructor'));
        $this->assertTrue($this->application->objects()->has('ClassWithoutParameters'));
        $this->assertTrue($this->application->objects()->has('ClassWithDefaultParameters'));
        $this->assertTrue($this->application->objects()->has('ClassWithDependency'));
        $this->assertFalse($this->application->objects()->has('SomeClass'));
    }

    public function testGetData(): void
    {
        $this->application->request()->get()->set(['key' => 'value']);
        $this->assertEquals('value', $this->application->request()->get()->get('key'));
        $this->assertContains('value', $this->application->request()->get()->get());
        $this->assertTrue($this->application->request()->get()->has('key'));
        $this->assertFalse($this->application->request()->get()->has('false'));
    }

    public function testPostData(): void
    {
        $this->application->request()->post()->set(['key' => 'value']);
        $this->assertEquals('value', $this->application->request()->post()->get('key'));
        $this->assertContains('value', $this->application->request()->post()->get());
        $this->assertTrue($this->application->request()->post()->has('key'));
        $this->assertFalse($this->application->request()->post()->has('false'));
    }

    public function testServerData(): void
    {
        $this->application->request()->server()->set(['key' => 'value']);
        $this->assertEquals('value', $this->application->request()->server()->get('key'));
        $this->assertArrayHasKey('key', $this->application->request()->server()->get());
    }

    public function testSessionData(): void
    {
        $this->application->session()->set(['key', 'value']);
        $this->application->session()->set(['subKey', ['subSet' => 'value']]);
        $this->application->session()->set(['increment', ['increment' => 'value']]);
        $this->assertEquals('value', $this->application->session()->get('key'));
        $this->assertEquals('value', $this->application->session()->get('subKey')['subSet']);
        $this->assertEquals('value', $this->application->session()->get('increment')[0]['increment']);
        $this->assertTrue($this->application->session()->has('key'));
        $this->assertTrue($this->application->session()->has('subKey', 'subSet'));
        $this->assertNull($this->application->session()->unset('key'));
        $this->assertNull($this->application->session()->unset('subKey', 'subSet'));
        $this->assertFalse($this->application->session()->has('key'));
        $this->assertFalse($this->application->session()->has('subKey', 'subSet'));
        $this->assertNull($this->application->session()->clear());
    }

    public function testCookieData(): void
    {
        $this->application->cookie()->set(['key', 'value']);
        $this->assertEquals('value', $this->application->cookie()->get('key'));
        $this->assertTrue($this->application->cookie()->has('key'));
        $this->assertFalse($this->application->cookie()->has('false'));
    }

    public function testFilesData(): void
    {
        $this->application->request()->files()->set(
            [
                'upload' => ['name' => ['img' => '41146.png']],
                'type' => ['img' => 'image/png'],
            ]
        );

        $this->assertTrue($this->application->request()->files()->isLoaded('img'));
        $this->assertTrue($this->application->request()->files()->isFileType('img', 'image/png'));
        $this->assertEquals('41146.png', $this->application->request()->files()->getLoaded('img', 'name'));
    }
}
