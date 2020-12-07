<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 *
 *  phpunit src/tests/ContainerTest --coverage-html src/tests/coverage-html
 */

namespace Rudra\Container\Tests;

use Rudra\Container\{Container,
    Facades\Request,
    Facades\Response,
    Facades\Rudra,
    Facades\Session,
    Facades\Cookie,
    Interfaces\RudraInterface};
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
        Rudra::binding([RudraInterface::class => Rudra::run()]);
        Rudra::services([
                    "CWC" => ClassWithoutConstructor::class,
                    "CWP" => ClassWithoutParameters::class,
                    "CWDP" => [ClassWithDefaultParameters::class, ["123"]],
                    "CWD" => ClassWithDependency::class
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

    public function testGetInvalidArgumentException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
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

    public function testConfig(): void
    {
        Rudra::set(["config", new Container([])]);
        Rudra::config()->set(["key" => "value"]);
        $this->assertEquals("value", Rudra::config()->get("key"));
    }

    public function testGetData(): void
    {
        Rudra::request()->get()->set(["key" => "value"]);
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

    public function testPutData(): void
    {
        Request::put()->set(["key" => "value"]);
        $this->assertEquals("value", Request::put()->get("key"));
        $this->assertContains("value", Request::put()->get());
        $this->assertTrue(Request::put()->has("key"));
        $this->assertFalse(Request::put()->has("false"));
    }

    public function testPatchData(): void
    {
        Request::patch()->set(["key" => "value"]);
        $this->assertEquals("value", Request::patch()->get("key"));
        $this->assertContains("value", Request::patch()->get());
        $this->assertTrue(Request::patch()->has("key"));
        $this->assertFalse(Request::patch()->has("false"));
    }

    public function testDeleteData(): void
    {
        Request::delete()->set(["key" => "value"]);
        $this->assertEquals("value", Request::delete()->get("key"));
        $this->assertContains("value", Request::delete()->get());
        $this->assertTrue(Request::delete()->has("key"));
        $this->assertFalse(Request::delete()->has("false"));
    }

    public function testServerData(): void
    {
        Request::server()->set(["key" => "value"]);
        $this->assertEquals("value", Request::server()->get("key"));
        $this->assertArrayHasKey("key", Request::server()->get());
    }

    /**
     * @runInSeparateProcess
     */
    public function testJsonResponse(): void
    {
        ob_start();
        Response::json(["key" => "value"]);
        $this->assertEquals(["key" => "value"], json_decode(ob_get_clean(), true));
        ob_clean();

        ob_start();
        Rudra::response()->json(["key" => "value"]);
        $this->assertEquals(["key" => "value"], json_decode(ob_get_clean(), true));
    }

    public function testSessionData(): void
    {
        Rudra::session()->set(["key", "value"]);
        Session::set(["subKey", ["subSet" => "value"]]);
        $this->assertTrue(is_array(Session::get()));
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
        $this->expectException(\InvalidArgumentException::class);
        Session::get("wrongKey");
    }

    public function testSessionDataSetEmptyData(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Session::set([]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testCookieData(): void
    {
        Cookie::set(["key", "value"]);
        var_dump(Cookie::get());
        $this->assertTrue(is_array(Cookie::get()));
//        $this->assertEquals("value", Cookie::get("key"));
//        $this->assertTrue(Cookie::has("key"));
//        $this->assertFalse(Cookie::has("false"));
    }

    public function testCookieDataGetWrongKey(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Cookie::get("wrongKey");
    }

    public function testCookieDataSetEmptyData(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Cookie::set([]);
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
