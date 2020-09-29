<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 *
 *  phpunit src/tests/ContainerTest --coverage-html src/tests/coverage-html
 */

namespace Rudra\Container\Tests;

use Rudra\Container\{Abstracts\AbstractApplication, Abstracts\RudraInterface, Request, Container, Rudra};
use Rudra\Container\Tests\Stub\{
    ClassWithDependency, ClassWithoutParameters, ClassWithoutConstructor, ClassWithDefaultParameters
};
use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;

class ContainerTest extends PHPUnit_Framework_TestCase
{
    private RudraInterface $rudra;

    protected function setUp(): void
    {
        $this->rudra = Rudra::run();
        Rudra::_setServices(
            [
                "contracts" => [
                    RudraInterface::class => Rudra::run(),
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
    }

    public function testInstances()
    {
        $this->assertInstanceOf(Request::class, Rudra::_request());
        $this->assertInstanceOf(Container::class, Rudra::_binding());

        $this->assertInstanceOf(Request::class, $this->rudra->request());
        $this->assertInstanceOf(Container::class, $this->rudra->binding());
    }

    public function testGet(): void
    {
        $this->assertTrue(count(Rudra::_get()) > 0);
    }

    public function testSetServices(): void
    {
        $this->assertInstanceOf(ClassWithoutConstructor::class, Rudra::_get("CWC"));
        $this->assertInstanceOf(ClassWithoutParameters::class, Rudra::_get("CWP"));
        $this->assertInstanceOf(ClassWithDefaultParameters::class, Rudra::_get("CWDP"));
    }

    public function testSetRaw(): void
    {
        Rudra::_set([ContainerTest::class, $this]);
        $this->assertInstanceOf(ContainerTest::class, Rudra::_get(ContainerTest::class));
    }

    public function testGetArrayHasKey(): void
    {
        Rudra::_set([ContainerTest::class, $this]);
        $this->assertArrayHasKey(ContainerTest::class, Rudra::_get());
    }

    public function testIoCClassWithoutConstructor(): void
    {
        $newClassWithoutConstructor = Rudra::_new(ClassWithoutConstructor::class);
        $this->assertInstanceOf(ClassWithoutConstructor::class, $newClassWithoutConstructor);

        Rudra::_set(["ClassWithoutConstructor", $newClassWithoutConstructor]);
        $this->assertInstanceOf(ClassWithoutConstructor::class, Rudra::_get("ClassWithoutConstructor"));
    }

    public function testIoCwithoutParameters(): void
    {
        $newClassWithoutParameters = Rudra::_new(ClassWithoutParameters::class);
        $this->assertInstanceOf(ClassWithoutParameters::class, $newClassWithoutParameters);

        Rudra::_set(["ClassWithoutParameters", $newClassWithoutParameters]);
        $this->assertInstanceOf(ClassWithoutParameters::class, Rudra::_get("ClassWithoutParameters"));
    }

    public function testIoCwithDefaultParameters(): void
    {
        $newClassWithDefaultParameters = Rudra::_new(ClassWithDefaultParameters::class);
        $this->assertEquals("Default", $newClassWithDefaultParameters->getParam());

        $newClassWithDefaultParameters = Rudra::_new(ClassWithDefaultParameters::class, ["Test"]);
        $this->assertEquals("Test", $newClassWithDefaultParameters->getParam());

        Rudra::_set(["ClassWithDefaultParameters", $newClassWithDefaultParameters]);
        $this->assertInstanceOf(ClassWithDefaultParameters::class, Rudra::_get("ClassWithDefaultParameters"));
    }

    public function testIoCwithDependency(): void
    {
        $newClassWithDependency = Rudra::_new(ClassWithDependency::class);
        $this->assertInstanceOf(ClassWithDependency::class, $newClassWithDependency);

        Rudra::_set(["ClassWithDependency", $newClassWithDependency]);
        $this->assertInstanceOf(ClassWithDependency::class, Rudra::_get("ClassWithDependency"));
    }

    public function testHas(): void
    {
        $this->assertTrue(Rudra::_has(ContainerTest::class));
        $this->assertTrue(Rudra::_has("ClassWithoutConstructor"));
        $this->assertTrue(Rudra::_has("ClassWithoutParameters"));
        $this->assertTrue(Rudra::_has("ClassWithDefaultParameters"));
        $this->assertTrue(Rudra::_has("ClassWithDependency"));
        $this->assertFalse(Rudra::_has("SomeClass"));
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
        Rudra::_session()->set(["key", "value"]);
        Rudra::_session()->set(["subKey", ["subSet" => "value"]]);
        Rudra::_session()->set(["increment", ["increment" => "value"]]);
        $this->assertEquals("value", Rudra::_session()->get("key"));
        $this->assertEquals("value", Rudra::_session()->get("subKey")["subSet"]);
        $this->assertEquals("value", Rudra::_session()->get("increment")[0]["increment"]);
        $this->assertTrue(Rudra::_session()->has("key"));
        $this->assertTrue(Rudra::_session()->has("subKey", "subSet"));
        $this->assertNull(Rudra::_session()->unset("key"));
        $this->assertNull(Rudra::_session()->unset("subKey", "subSet"));
        $this->assertFalse(Rudra::_session()->has("key"));
        $this->assertFalse(Rudra::_session()->has("subKey", "subSet"));
        $this->assertNull(Rudra::_session()->clear());
    }

    public function testCookieData(): void
    {
        Rudra::_cookie()->set(["key", "value"]);
        $this->assertEquals("value", Rudra::_cookie()->get("key"));
        $this->assertTrue(Rudra::_cookie()->has("key"));
        $this->assertFalse(Rudra::_cookie()->has("false"));
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
