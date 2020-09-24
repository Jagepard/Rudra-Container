<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 *
 *  phpunit src/tests/ContainerTest --coverage-html src/tests/coverage-html
 */

namespace Rudra\Container\Tests;

use Rudra\Container\{Abstracts\AbstractApplication, Cookie, Request, Container, Rudra, Session};
use Rudra\Container\Tests\Stub\{
    ClassWithDependency, ClassWithoutParameters, ClassWithoutConstructor, ClassWithDefaultParameters
};
use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;

class ContainerTest extends PHPUnit_Framework_TestCase
{
    protected AbstractApplication $application;

    protected function setUp(): void
    {
        $this->application = Rudra::run();
        Rudra::setServices(
            [
                "contracts" => [
                    AbstractApplication::class => $this->application,
                ],

                "services" => [
                    "CWC" => ClassWithoutConstructor::class,
                    "CWP" => ClassWithoutParameters::class,
                    "CWDP" => [ClassWithDefaultParameters::class, ["123"]],
                ],

                "config" => []
            ]
        );
    }

    public function testCallSingleton(): void
    {
        $this->assertInstanceOf(Rudra::class, Rudra::run());
        $this->assertInstanceOf(Rudra::class, $this->application);
    }

    public function testInstances()
    {
        $this->assertInstanceOf(Request::class, Rudra::request());
        $this->assertInstanceOf(Container::class, Rudra::binding());
    }

    public function testGet(): void
    {
        $this->assertTrue(count($this->application->get()) > 0);
    }

    public function testSetServices(): void
    {
        $this->assertInstanceOf(ClassWithoutConstructor::class, $this->application->get("CWC"));
        $this->assertInstanceOf(ClassWithoutParameters::class, $this->application->get("CWP"));
        $this->assertInstanceOf(ClassWithDefaultParameters::class, $this->application->get("CWDP"));
    }

    public function testSetRaw(): void
    {
        $this->application->set([ContainerTest::class, $this]);
        $this->assertInstanceOf(ContainerTest::class, $this->application->get(ContainerTest::class));
    }

    public function testGetArrayHasKey(): void
    {
        $this->application->set([ContainerTest::class, $this]);
        $this->assertArrayHasKey(ContainerTest::class, $this->application->get());
    }

    public function testIoCClassWithoutConstructor(): void
    {
        $newClassWithoutConstructor = Rudra::new(ClassWithoutConstructor::class);
        $this->assertInstanceOf(ClassWithoutConstructor::class, $newClassWithoutConstructor);

        $this->application->set(["ClassWithoutConstructor", $newClassWithoutConstructor]);
        $this->assertInstanceOf(ClassWithoutConstructor::class, $this->application->get("ClassWithoutConstructor"));
    }

    public function testIoCwithoutParameters(): void
    {
        $newClassWithoutParameters = Rudra::new(ClassWithoutParameters::class);
        $this->assertInstanceOf(ClassWithoutParameters::class, $newClassWithoutParameters);

        $this->application->set(["ClassWithoutParameters", $newClassWithoutParameters]);
        $this->assertInstanceOf(ClassWithoutParameters::class, $this->application->get("ClassWithoutParameters"));
    }

    public function testIoCwithDefaultParameters(): void
    {
        $newClassWithDefaultParameters = Rudra::new(ClassWithDefaultParameters::class);
        $this->assertEquals("Default", $newClassWithDefaultParameters->getParam());

        $newClassWithDefaultParameters = Rudra::new(ClassWithDefaultParameters::class, ["Test"]);
        $this->assertEquals("Test", $newClassWithDefaultParameters->getParam());

        $this->application->set(["ClassWithDefaultParameters", $newClassWithDefaultParameters]);
        $this->assertInstanceOf(ClassWithDefaultParameters::class, $this->application->get("ClassWithDefaultParameters"));
    }

    public function testIoCwithDependency(): void
    {
        $newClassWithDependency = Rudra::new(ClassWithDependency::class);
        $this->assertInstanceOf(ClassWithDependency::class, $newClassWithDependency);

        $this->application->set(["ClassWithDependency", $newClassWithDependency]);
        $this->assertInstanceOf(ClassWithDependency::class, $this->application->get("ClassWithDependency"));
    }

    public function testHas(): void
    {
        $this->assertTrue($this->application->has(ContainerTest::class));
        $this->assertTrue($this->application->has("ClassWithoutConstructor"));
        $this->assertTrue($this->application->has("ClassWithoutParameters"));
        $this->assertTrue($this->application->has("ClassWithDefaultParameters"));
        $this->assertTrue($this->application->has("ClassWithDependency"));
        $this->assertFalse($this->application->has("SomeClass"));
    }

    public function testGetData(): void
    {
        Request::get()->set(["key" => "value"]);
        $this->assertEquals("value", Request::get()->get("key"));
        $this->assertContains("value", Request::get()->get());
        $this->assertTrue(Request::get()->has("key"));
        $this->assertFalse(Request::get()->has("false"));
    }

    public function testPostData(): void
    {
        Request::post()->set(["key" => "value"]);
        $this->assertEquals("value", Request::post()->get("key"));
        $this->assertContains("value", Request::post()->get());
        $this->assertTrue(Request::post()->has("key"));
        $this->assertFalse(Request::post()->has("false"));
    }

    public function testServerData(): void
    {
        Request::server()->set(["key" => "value"]);
        $this->assertEquals("value", Request::server()->get("key"));
        $this->assertArrayHasKey("key", Request::server()->get());
    }

    public function testSessionData(): void
    {
        Rudra::session()->set(["key", "value"]);
        Rudra::session()->set(["subKey", ["subSet" => "value"]]);
        Rudra::session()->set(["increment", ["increment" => "value"]]);
        $this->assertEquals("value", Rudra::session()->get("key"));
        $this->assertEquals("value", Rudra::session()->get("subKey")["subSet"]);
        $this->assertEquals("value", Rudra::session()->get("increment")[0]["increment"]);
        $this->assertTrue(Rudra::session()->has("key"));
        $this->assertTrue(Rudra::session()->has("subKey", "subSet"));
        $this->assertNull(Rudra::session()->unset("key"));
        $this->assertNull(Rudra::session()->unset("subKey", "subSet"));
        $this->assertFalse(Rudra::session()->has("key"));
        $this->assertFalse(Rudra::session()->has("subKey", "subSet"));
        $this->assertNull(Rudra::session()->clear());
    }

    public function testCookieData(): void
    {
        Rudra::cookie()->set(["key", "value"]);
        $this->assertEquals("value", Rudra::cookie()->get("key"));
        $this->assertTrue(Rudra::cookie()->has("key"));
        $this->assertFalse(Rudra::cookie()->has("false"));
    }

    public function testFilesData(): void
    {
        Request::files()->set(
            [
                "upload" => ["name" => ["img" => "41146.png"]],
                "type" => ["img" => "image/png"],
            ]
        );

        $this->assertTrue(Request::files()->isLoaded("img"));
        $this->assertTrue(Request::files()->isFileType("img", "image/png"));
        $this->assertEquals("41146.png", Request::files()->getLoaded("img", "name"));
    }
}
