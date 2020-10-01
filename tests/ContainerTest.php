<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 *
 *  phpunit src/tests/ContainerTest --coverage-html src/tests/coverage-html
 */

namespace Rudra\Container\Tests;

use Rudra\Container\{
    Container,
    Facades\Request,
    Facades\Rudra,
    Facades\Session,
    Facades\Cookie,
    Interfaces\RudraInterface
};
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
        Rudra::setServices(
            [
                "contracts" => [RudraInterface::class => Rudra::run()],

                "services" => [
                    "CWC" => ClassWithoutConstructor::class,
                    "CWP" => ClassWithoutParameters::class,
                    "CWDP" => [ClassWithDefaultParameters::class, ["123"]],
                ],
            ]
        );
    }

    public function testInstances()
    {
        $this->assertInstanceOf(Container::class, Rudra::binding());
        $this->assertInstanceOf(Container::class, $this->rudra->binding());
    }

    public function testGet(): void
    {
        $this->assertTrue(count(Rudra::get()) > 0);
    }

    public function testSetServices(): void
    {
        $this->assertInstanceOf(ClassWithoutConstructor::class, Rudra::get("CWC"));
        $this->assertInstanceOf(ClassWithoutParameters::class, Rudra::get("CWP"));
        $this->assertInstanceOf(ClassWithDefaultParameters::class, Rudra::get("CWDP"));
    }

    public function testSetRaw(): void
    {
        Rudra::set([ContainerTest::class, $this]);
        $this->assertInstanceOf(ContainerTest::class, Rudra::get(ContainerTest::class));
    }

    public function testGetArrayHasKey(): void
    {
        Rudra::set([ContainerTest::class, $this]);
        $this->assertArrayHasKey(ContainerTest::class, Rudra::get());
    }

    public function testIoCClassWithoutConstructor(): void
    {
        $newClassWithoutConstructor = Rudra::new(ClassWithoutConstructor::class);
        $this->assertInstanceOf(ClassWithoutConstructor::class, $newClassWithoutConstructor);

        Rudra::set(["ClassWithoutConstructor", $newClassWithoutConstructor]);
        $this->assertInstanceOf(ClassWithoutConstructor::class, Rudra::get("ClassWithoutConstructor"));
    }

    public function testIoCwithoutParameters(): void
    {
        $newClassWithoutParameters = Rudra::new(ClassWithoutParameters::class);
        $this->assertInstanceOf(ClassWithoutParameters::class, $newClassWithoutParameters);

        Rudra::set(["ClassWithoutParameters", $newClassWithoutParameters]);
        $this->assertInstanceOf(ClassWithoutParameters::class, Rudra::get("ClassWithoutParameters"));
    }

    public function testIoCwithDefaultParameters(): void
    {
        $newClassWithDefaultParameters = Rudra::new(ClassWithDefaultParameters::class);
        $this->assertEquals("Default", $newClassWithDefaultParameters->getParam());

        $newClassWithDefaultParameters = Rudra::new(ClassWithDefaultParameters::class, ["Test"]);
        $this->assertEquals("Test", $newClassWithDefaultParameters->getParam());

        Rudra::set(["ClassWithDefaultParameters", $newClassWithDefaultParameters]);
        $this->assertInstanceOf(ClassWithDefaultParameters::class, Rudra::get("ClassWithDefaultParameters"));
    }

    public function testIoCwithDependency(): void
    {
        $newClassWithDependency = Rudra::new(ClassWithDependency::class);
        $this->assertInstanceOf(ClassWithDependency::class, $newClassWithDependency);

        Rudra::set(["ClassWithDependency", $newClassWithDependency]);
        $this->assertInstanceOf(ClassWithDependency::class, Rudra::get("ClassWithDependency"));
    }

    public function testHas(): void
    {
        $this->assertTrue(Rudra::has(ContainerTest::class));
        $this->assertTrue(Rudra::has("ClassWithoutConstructor"));
        $this->assertTrue(Rudra::has("ClassWithoutParameters"));
        $this->assertTrue(Rudra::has("ClassWithDefaultParameters"));
        $this->assertTrue(Rudra::has("ClassWithDependency"));
        $this->assertFalse(Rudra::has("SomeClass"));
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
        Session::set(["key", "value"]);
        Session::set(["subKey", ["subSet" => "value"]]);
        Session::set(["increment", ["increment" => "value"]]);
        $this->assertEquals("value", Session::get("key"));
        $this->assertEquals("value", Session::get("subKey")["subSet"]);
        $this->assertEquals("value", Session::get("increment")[0]["increment"]);
        $this->assertTrue(Session::has("key"));
        $this->assertTrue(Session::has("subKey", "subSet"));
        $this->assertNull(Session::unset("key"));
        $this->assertNull(Session::unset("subKey", "subSet"));
        $this->assertFalse(Session::has("key"));
        $this->assertFalse(Session::has("subKey", "subSet"));
        $this->assertNull(Session::clear());
    }

    public function testCookieData(): void
    {
        Cookie::set(["key", "value"]);
        $this->assertEquals("value", Cookie::get("key"));
        $this->assertTrue(Cookie::has("key"));
        $this->assertFalse(Cookie::has("false"));
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
