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
use Rudra\Container\Rudra as R;
use Rudra\Container\Facades\{Cookie, Request, Response, Rudra, Session};
use Rudra\Container\Interfaces\RudraInterface;
use Rudra\Container\Tests\Stub\{BindingClass, BindingClassTest, ClassWithDefaultParameters,
    ClassWithDependency,
    ClassWithoutConstructor,
    ClassWithoutParameters
};
use Rudra\Container\Exceptions\NotFoundException;
use PHPUnit\Framework\{TestCase as PHPUnit_Framework_TestCase};
use Rudra\Container\Tests\Stub\Factories\BindingFactoryString;
use Rudra\Container\Tests\Stub\Factories\BindingFactory;
use Rudra\Container\Tests\Stub\Interfaces\BindInterface;

class RudraTest extends PHPUnit_Framework_TestCase
{
    private RudraInterface $rudra;

    protected function setUp(): void
    {
        $this->rudra = Rudra::run();
        Rudra::binding([
            RudraInterface::class => Rudra::run(),
            \stdClass::class      => 'callable',
        ]);
        Rudra::waiting([
                "CWC"  => ClassWithoutConstructor::class,
                "CWP"  => ClassWithoutParameters::class,
                "CWDP" => [ClassWithDefaultParameters::class, ["123"]],
                "CWD"  => ClassWithDependency::class,
                'callable' => function (){
                    $std = new \stdClass;
                    $std->info = 'Created from waiting';
            
                    return $std;
                },
            ]
        );
    }

    public function testBindingClosure()
    {
        Rudra::binding()->set([BindInterface::class => fn() => new BindingClass()]);

        $bc = Rudra::new(BindingClassTest::class);
        $this->assertEquals("Default", $bc->getParam());
        $this->assertInstanceOf(BindInterface::class, $bc->getBind());

        Rudra::set([BindingClassTest::class, BindingClassTest::class]);
        $this->assertEquals("Default", Rudra::get(BindingClassTest::class)->getParam());
        $this->assertInstanceOf(BindInterface::class, Rudra::get(BindingClassTest::class)->getBind());
    }

    public function testBindingFactoryString()
    {
        Rudra::binding()->set([BindInterface::class => BindingFactoryString::class]);

        $bc = Rudra::new(BindingClassTest::class);
        $this->assertEquals("Default", $bc->getParam());
        $this->assertInstanceOf(BindInterface::class, $bc->getBind());

        Rudra::set([BindingClassTest::class, BindingClassTest::class]);
        $this->assertEquals("Default", Rudra::get(BindingClassTest::class)->getParam());
        $this->assertInstanceOf(BindInterface::class, Rudra::get(BindingClassTest::class)->getBind());
    }

    public function testBindingFactory()
    {
        Rudra::binding()->set([BindInterface::class => BindingFactory::class]);

        $bc = Rudra::new(BindingClassTest::class);
        $this->assertEquals("Default", $bc->getParam());
        $this->assertInstanceOf(BindInterface::class, $bc->getBind());

        Rudra::set([BindingClassTest::class, BindingClassTest::class]);
        $this->assertEquals("Default", Rudra::get(BindingClassTest::class)->getParam());
        $this->assertInstanceOf(BindInterface::class, Rudra::get(BindingClassTest::class)->getBind());
    }

    public function testBindingString()
    {
        Rudra::binding()->set([BindInterface::class => BindingClass::class]);

        $bc = Rudra::new(BindingClassTest::class);
        $this->assertEquals("Default", $bc->getParam());
        $this->assertInstanceOf(BindInterface::class, $bc->getBind());

        Rudra::set([BindingClassTest::class, BindingClassTest::class]);
        $this->assertEquals("Default", Rudra::get(BindingClassTest::class)->getParam());
        $this->assertInstanceOf(BindInterface::class, Rudra::get(BindingClassTest::class)->getBind());
    }

    public function testBindingFactoryClass()
    {
        Rudra::binding()->set([BindInterface::class => new BindingFactory]);

        $bc = Rudra::new(BindingClassTest::class);
        $this->assertEquals("Default", $bc->getParam());
        $this->assertInstanceOf(BindInterface::class, $bc->getBind());

        Rudra::set([BindingClassTest::class, BindingClassTest::class]);
        $this->assertEquals("Default", Rudra::get(BindingClassTest::class)->getParam());
        $this->assertInstanceOf(BindInterface::class, Rudra::get(BindingClassTest::class)->getBind());
    }

    public function testBindingFactoryStringClass()
    {
        Rudra::binding()->set([BindInterface::class => new BindingFactoryString]);

        $bc = Rudra::new(BindingClassTest::class);
        $this->assertEquals("Default", $bc->getParam());
        $this->assertInstanceOf(BindInterface::class, $bc->getBind());

        Rudra::set([BindingClassTest::class, BindingClassTest::class]);
        $this->assertEquals("Default", Rudra::get(BindingClassTest::class)->getParam());
        $this->assertInstanceOf(BindInterface::class, Rudra::get(BindingClassTest::class)->getBind());
    }

    public function testBindingClass()
    {
        Rudra::binding()->set([BindInterface::class => new BindingClass]);

        $bc = Rudra::new(BindingClassTest::class);
        $this->assertEquals("Default", $bc->getParam());
        $this->assertInstanceOf(BindInterface::class, $bc->getBind());

        Rudra::set([BindingClassTest::class, BindingClassTest::class]);
        $this->assertEquals("Default", Rudra::get(BindingClassTest::class)->getParam());
        $this->assertInstanceOf(BindInterface::class, Rudra::get(BindingClassTest::class)->getBind());
    }

    public function testWaitingClosure()
    {
        Rudra::binding()->set([BindInterface::class => BindInterface::class]);
        Rudra::waiting()->set([BindInterface::class => fn() => new BindingClass()]);

        $bc = Rudra::new(BindingClassTest::class);
        $this->assertEquals("Default", $bc->getParam());
        $this->assertInstanceOf(BindInterface::class, $bc->getBind());

        Rudra::set([BindingClassTest::class, BindingClassTest::class]);
        $this->assertEquals("Default", Rudra::get(BindingClassTest::class)->getParam());
        $this->assertInstanceOf(BindInterface::class, Rudra::get(BindingClassTest::class)->getBind());
    }

    public function testWaitingFactory()
    {
        Rudra::binding()->set([BindInterface::class => BindInterface::class]);
        Rudra::waiting()->set([BindInterface::class => BindingFactory::class]);

        $bc = Rudra::new(BindingClassTest::class);
        $this->assertEquals("Default", $bc->getParam());
        $this->assertInstanceOf(BindInterface::class, $bc->getBind());

        Rudra::set([BindingClassTest::class, BindingClassTest::class]);
        $this->assertEquals("Default", Rudra::get(BindingClassTest::class)->getParam());
        $this->assertInstanceOf(BindInterface::class, Rudra::get(BindingClassTest::class)->getBind());
    }

    public function testWaitingFactoryString()
    {
        Rudra::binding()->set([BindInterface::class => BindInterface::class]);
        Rudra::waiting()->set([BindInterface::class => BindingFactoryString::class]);

        $bc = Rudra::new(BindingClassTest::class);
        $this->assertEquals("Default", $bc->getParam());
        $this->assertInstanceOf(BindInterface::class, $bc->getBind());

        Rudra::set([BindingClassTest::class, BindingClassTest::class]);
        $this->assertEquals("Default", Rudra::get(BindingClassTest::class)->getParam());
        $this->assertInstanceOf(BindInterface::class, Rudra::get(BindingClassTest::class)->getBind());
    }

    public function testWaitingString()
    {
        Rudra::binding()->set([BindInterface::class => BindInterface::class]);
        Rudra::waiting()->set([BindInterface::class => BindingClass::class]);

        $bc = Rudra::new(BindingClassTest::class);
        $this->assertEquals("Default", $bc->getParam());
        $this->assertInstanceOf(BindInterface::class, $bc->getBind());

        Rudra::set([BindingClassTest::class, BindingClassTest::class]);
        $this->assertEquals("Default", Rudra::get(BindingClassTest::class)->getParam());
        $this->assertInstanceOf(BindInterface::class, Rudra::get(BindingClassTest::class)->getBind());
    }

    public function testWaitingClass()
    {
        Rudra::binding()->set([BindInterface::class => BindInterface::class]);
        Rudra::waiting()->set([BindInterface::class => new BindingClass()]);

        $bc = Rudra::new(BindingClassTest::class);
        $this->assertEquals("Default", $bc->getParam());
        $this->assertInstanceOf(BindInterface::class, $bc->getBind());

        Rudra::set([BindingClassTest::class, BindingClassTest::class]);
        $this->assertEquals("Default", Rudra::get(BindingClassTest::class)->getParam());
        $this->assertInstanceOf(BindInterface::class, Rudra::get(BindingClassTest::class)->getBind());
    }

    public function testWaitingFactoryClass()
    {
        Rudra::binding()->set([BindInterface::class => BindInterface::class]);
        Rudra::waiting()->set([BindInterface::class => new BindingFactory]);

        $bc = Rudra::new(BindingClassTest::class);
        $this->assertEquals("Default", $bc->getParam());
        $this->assertInstanceOf(BindInterface::class, $bc->getBind());

        Rudra::set([BindingClassTest::class, BindingClassTest::class]);
        $this->assertEquals("Default", Rudra::get(BindingClassTest::class)->getParam());
        $this->assertInstanceOf(BindInterface::class, Rudra::get(BindingClassTest::class)->getBind());
    }

    public function testWaitingFactoryStringClass()
    {
        Rudra::binding()->set([BindInterface::class => BindInterface::class]);
        Rudra::waiting()->set([BindInterface::class => new BindingFactoryString]);

        $bc = Rudra::new(BindingClassTest::class);
        $this->assertEquals("Default", $bc->getParam());
        $this->assertInstanceOf(BindInterface::class, $bc->getBind());

        Rudra::set([BindingClassTest::class, BindingClassTest::class]);
        $this->assertEquals("Default", Rudra::get(BindingClassTest::class)->getParam());
        $this->assertInstanceOf(BindInterface::class, Rudra::get(BindingClassTest::class)->getBind());
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
        $this->assertInstanceOf(\stdClass::class, $newClassWithDefaultParameters->getStd());
        $this->assertEquals("Created from waiting", $newClassWithDefaultParameters->getStd()->info);

        Rudra::set(["ClassWithDefaultParameters", $newClassWithDefaultParameters]);
        $this->assertInstanceOf(ClassWithDefaultParameters::class, Rudra::get("ClassWithDefaultParameters"));
        $this->assertInstanceOf(\stdClass::class, Rudra::get("ClassWithDefaultParameters")->getStd());
        $this->assertEquals("Created from waiting", Rudra::get("ClassWithDefaultParameters")->getStd()->info);
    }

    public function testIoCwithDependency(): void
    {
        $newClassWithDependency = Rudra::new(ClassWithDependency::class);
        $this->assertInstanceOf(R::class, $newClassWithDependency->rudra());

        Rudra::set(["ClassWithDependency", $newClassWithDependency]);
        $this->assertInstanceOf(ClassWithDependency::class, Rudra::get("ClassWithDependency"));
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

    // public function testSessionDataGetWrongKey(): void
    // {
    //     $_SESSION = [];

    //     $this->expectException(NotFoundException::class);
    //     Session::get("wrongKey");
    // }

    public function testSessionDataSetEmptyData(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Session::set([]);
    }
}
