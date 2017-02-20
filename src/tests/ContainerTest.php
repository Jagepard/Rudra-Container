<?php

use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;
use Rudra\Container;
use Rudra\IContainer;

/**
 * Date: 17.02.17
 * Time: 13:23
 *
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2016, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 *
 *  phpunit src/tests/ContainerTest --coverage-html src/tests/coverage-html
 */
class ContainerTest extends PHPUnit_Framework_TestCase
{

    protected $container;
    protected $bind;
    protected $app;

    protected function setUp()
    {
        $this->container = Container::app();
        Container::$app->setBinding(IContainer::class, Container::$app);

        $this->app = [
            'contracts' => [
                IContainer::class => Container::$app
            ],

            'services' => [
                'CWC'  => ['ClassWithoutConstructor'],
                'CWP'  => ['ClassWithoutParameters'],
                'CWDP' => ['ClassWithDefaultParameters', ['param' => '123']],
            ]
        ];
    }

    /**
     * @return mixed
     */
    protected function container()
    {
        return $this->container;
    }

    /**
     * @return mixed
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * Проверяем синглтон
     */
    public function testCallSingleton()
    {
        $this->assertInstanceOf(Container::class, Container::app($this->bind));
        $this->assertInstanceOf(Container::class, Container::$app);
    }

    public function testGet()
    {
        $this->assertTrue(empty($this->container()->get()));
    }

    public function testSetServices()
    {
        $this->container()->setServices($this->getApp());
        $this->assertInstanceOf('ClassWithoutConstructor', $this->container()->get('CWC'));
        $this->assertInstanceOf('ClassWithoutParameters', $this->container()->get('CWP'));
        $this->assertInstanceOf('ClassWithDefaultParameters', $this->container()->get('CWDP'));
    }

    public function testSetRaw()
    {
        $this->container()->set(ContainerTest::class, $this, 'raw');
        $this->assertInstanceOf(ContainerTest::class, $this->container()->get(ContainerTest::class));
    }

    public function testGetArrayHasKey()
    {
        $this->assertArrayHasKey(ContainerTest::class, $this->container()->get());
    }

    public function testIoCClassWithoutConstructor()
    {
        $newClassWithoutConstructor = $this->container()->new('ClassWithoutConstructor');
        $this->assertInstanceOf('ClassWithoutConstructor', $newClassWithoutConstructor);

        $this->container()->set('ClassWithoutConstructor', $newClassWithoutConstructor);
        $this->assertInstanceOf('ClassWithoutConstructor', $this->container()->get('ClassWithoutConstructor'));
    }

    public function testIoCwithoutParameters()
    {
        $newClassWithoutParameters = $this->container()->new('ClassWithoutParameters');
        $this->assertInstanceOf('ClassWithoutParameters', $newClassWithoutParameters);

        $this->container()->set('ClassWithoutParameters', $newClassWithoutParameters);
        $this->assertInstanceOf('ClassWithoutParameters', $this->container()->get('ClassWithoutParameters'));
    }

    public function testIoCwithDefaultParameters()
    {
        $newClassWithDefaultParameters = $this->container()->new('ClassWithDefaultParameters');
        $this->assertInstanceOf('ClassWithDefaultParameters', $newClassWithDefaultParameters);

        $this->container()->set('ClassWithDefaultParameters', $newClassWithDefaultParameters);
        $this->assertInstanceOf('ClassWithDefaultParameters', $this->container()->get('ClassWithDefaultParameters'));
    }

    public function testIoCwithDependency()
    {
        $newClassWithDependency = $this->container()->new('ClassWithDependency');
        $this->assertInstanceOf('ClassWithDependency', $newClassWithDependency);

        $this->container()->set('ClassWithDependency', $newClassWithDependency);
        $this->assertInstanceOf('ClassWithDependency', $this->container()->get('ClassWithDependency'));
    }

    public function testHas()
    {
        $this->assertTrue($this->container()->has(ContainerTest::class));
        $this->assertTrue($this->container()->has('ClassWithoutConstructor'));
        $this->assertTrue($this->container()->has('ClassWithoutParameters'));
        $this->assertTrue($this->container()->has('ClassWithDefaultParameters'));
        $this->assertTrue($this->container()->has('ClassWithDependency'));
        $this->assertFalse($this->container()->has('SomeClass'));
    }

    public function testSetParam()
    {
        $param = 'value';
        $this->container()->setParam('ClassWithDependency', 'param', $param);
        $this->assertEquals($param, $this->container()->getParam('ClassWithDependency', 'param'));
    }

    public function testHasParam()
    {
        $this->assertTrue($this->container()->hasParam('ClassWithDependency', 'param'));
        $this->assertNull($this->container()->hasParam('SomeClass', 'param'));
    }

    public function testFailureGetParam()
    {
        $this->assertNull($this->container()->getParam('SomeClass', 'param'));
    }

}
