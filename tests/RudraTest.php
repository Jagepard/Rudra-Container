<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 *
 *  phpunit src/tests/RudraTest --coverage-html src/tests/coverage-html
 */

namespace Rudra\Container\Tests;

use Rudra\Container\Container;
use Rudra\Container\Facades\{Cookie, Request, Response, Rudra, Session};
use Rudra\Container\Interfaces\RudraInterface;
use Rudra\Container\Tests\Stub\{ClassWithDefaultParameters,
    ClassWithDependency,
    ClassWithoutConstructor,
    ClassWithoutParameters
};
use Rudra\Container\Exceptions\NotFoundException;
use PHPUnit\Framework\{TestCase as PHPUnit_Framework_TestCase};

class RudraTest extends PHPUnit_Framework_TestCase
{
    private RudraInterface $rudra;

    protected function setUp(): void
    {
        $this->rudra = Rudra::run();
        Rudra::binding([RudraInterface::class => Rudra::run()]);
        Rudra::waiting([
                "CWC"  => ClassWithoutConstructor::class,
                "CWP"  => ClassWithoutParameters::class,
                "CWDP" => [ClassWithDefaultParameters::class, ["123"]],
                "CWD"  => ClassWithDependency::class
            ]
        );
    }

    public function testInstances()
    {
        $this->assertInstanceOf(Container::class, Rudra::binding());
        $this->assertInstanceOf(Container::class, $this->rudra->binding());
    }

    public function testGetNotFoundException(): void
    {
        $this->expectException(NotFoundException::class);
        Rudra::get("wrongKey");
    }

    public function testSetServices(): void
    {
        $this->assertInstanceOf(ClassWithoutConstructor::class, Rudra::get("CWC"));
        $this->assertInstanceOf(ClassWithoutParameters::class, Rudra::get("CWP"));
        $this->assertInstanceOf(ClassWithDefaultParameters::class, Rudra::get("CWDP"));
        $this->assertInstanceOf(ClassWithDependency::class, Rudra::get("CWD"));
    }

    public function testSetRudraContainersTrait()
    {
        $this->assertInstanceOf(\Rudra\Container\Rudra::class, Rudra::get("CWD")->rudra());
    }

    public function testSetRaw(): void
    {
        Rudra::set([RudraTest::class, $this]);
        $this->assertInstanceOf(RudraTest::class, Rudra::get(RudraTest::class));
    }

    public function testGetArrayHasKey(): void
    {
        Rudra::set([RudraTest::class, $this]);
        $this->assertTrue(Rudra::has(RudraTest::class));
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
        $this->assertTrue(Rudra::has(RudraTest::class));
        $this->assertTrue(Rudra::has("ClassWithoutConstructor"));
        $this->assertTrue(Rudra::has("ClassWithoutParameters"));
        $this->assertTrue(Rudra::has("ClassWithDefaultParameters"));
        $this->assertTrue(Rudra::has("ClassWithDependency"));
        $this->assertFalse(Rudra::has("SomeClass"));
    }

    public function testConfig(): void
    {
        Rudra::set(["config", new Container([])]);
        Rudra::config()->set(["key" => "value"]);
        $this->assertEquals("value", Rudra::config()->get("key"));
    }

    public function testSessionData(): void
    {
        $_SESSION = [];
        Rudra::session()->set(["key", "value"]);
        Session::set(["subKey", ["subSet" => "value"]]);
        $this->assertEquals("value", Session::get("key"));
        $this->assertEquals("value", Session::get("subKey")["subSet"]);
        $this->assertTrue(Session::has("key"));
        Session::unset("key");
        $this->assertFalse(Session::has("key"));
        Session::clear();
        $this->assertTrue(count($_SESSION) === 0);
    }

    public function testSessionDataGetWrongKey(): void
    {
        $_SESSION = [];

        $this->expectException(NotFoundException::class);
        Session::get("wrongKey");
    }

    public function testSessionDataSetEmptyData(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Session::set([]);
    }
}
