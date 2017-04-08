<?php

declare(strict_types = 1);

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


use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;
use Rudra\Container;
use Rudra\ContainerInterface;


/**
 * Class ContainerTest
 */
class ContainerTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var array
     */
    protected $app;

    protected function setUp(): void
    {
        $this->container = Container::app();
        Container::$app->setBinding(ContainerInterface::class, Container::$app);

        $this->app = [
            'contracts' => [
                ContainerInterface::class => Container::$app
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
    protected function container(): ContainerInterface
    {
        return $this->container;
    }

    /**
     * @return array
     */
    public function getApp(): array
    {
        return $this->app;
    }

    /**
     * Проверяем синглтон
     */
    public function testCallSingleton(): void
    {
        $this->assertInstanceOf(Container::class, Container::app());
        $this->assertInstanceOf(Container::class, Container::$app);
    }

    public function testGet(): void
    {
        $this->assertTrue(empty($this->container()->get()));
    }

    public function testSetServices(): void
    {
        $this->container()->setServices($this->getApp());
        $this->assertInstanceOf('ClassWithoutConstructor', $this->container()->get('CWC'));
        $this->assertInstanceOf('ClassWithoutParameters', $this->container()->get('CWP'));
        $this->assertInstanceOf('ClassWithDefaultParameters', $this->container()->get('CWDP'));
    }

    public function testSetRaw(): void
    {
        $this->container()->set(ContainerTest::class, $this, 'raw');
        $this->assertInstanceOf(ContainerTest::class, $this->container()->get(ContainerTest::class));
    }

    public function testGetArrayHasKey(): void
    {
        $this->assertArrayHasKey(ContainerTest::class, $this->container()->get());
    }

    public function testIoCClassWithoutConstructor(): void
    {
        $newClassWithoutConstructor = $this->container()->new('ClassWithoutConstructor');
        $this->assertInstanceOf('ClassWithoutConstructor', $newClassWithoutConstructor);

        $this->container()->set('ClassWithoutConstructor', $newClassWithoutConstructor);
        $this->assertInstanceOf('ClassWithoutConstructor', $this->container()->get('ClassWithoutConstructor'));
    }

    public function testIoCwithoutParameters(): void
    {
        $newClassWithoutParameters = $this->container()->new('ClassWithoutParameters');
        $this->assertInstanceOf('ClassWithoutParameters', $newClassWithoutParameters);

        $this->container()->set('ClassWithoutParameters', $newClassWithoutParameters);
        $this->assertInstanceOf('ClassWithoutParameters', $this->container()->get('ClassWithoutParameters'));
    }

    public function testIoCwithDefaultParameters(): void
    {
        $newClassWithDefaultParameters = $this->container()->new('ClassWithDefaultParameters');
        $this->assertInstanceOf('ClassWithDefaultParameters', $newClassWithDefaultParameters);

        $this->container()->set('ClassWithDefaultParameters', $newClassWithDefaultParameters);
        $this->assertInstanceOf('ClassWithDefaultParameters', $this->container()->get('ClassWithDefaultParameters'));
    }

    public function testIoCwithDependency(): void
    {
        $newClassWithDependency = $this->container()->new('ClassWithDependency');
        $this->assertInstanceOf('ClassWithDependency', $newClassWithDependency);

        $this->container()->set('ClassWithDependency', $newClassWithDependency);
        $this->assertInstanceOf('ClassWithDependency', $this->container()->get('ClassWithDependency'));
    }

    public function testHas(): void
    {
        $this->assertTrue($this->container()->has(ContainerTest::class));
        $this->assertTrue($this->container()->has('ClassWithoutConstructor'));
        $this->assertTrue($this->container()->has('ClassWithoutParameters'));
        $this->assertTrue($this->container()->has('ClassWithDefaultParameters'));
        $this->assertTrue($this->container()->has('ClassWithDependency'));
        $this->assertFalse($this->container()->has('SomeClass'));
    }

    public function testSetParam(): void
    {
        $param = 'value';
        $this->container()->setParam('ClassWithDependency', 'param', $param);
        $this->assertEquals($param, $this->container()->getParam('ClassWithDependency', 'param'));
    }

    public function testHasParam(): void
    {
        $this->assertTrue($this->container()->hasParam('ClassWithDependency', 'param'));
        $this->assertNull($this->container()->hasParam('SomeClass', 'param'));
    }

    public function testFailureGetParam(): void
    {
        $this->assertNull($this->container()->getParam('SomeClass', 'param'));
    }

    public function testGetData(): void
    {
        Container::$app->setGet(['key' => 'value']);
        $this->assertEquals('value', $this->container()->getGet('key'));
        $this->assertContains('value', $this->container()->getGet());
        $this->assertTrue($this->container()->hasGet('key'));
        $this->assertFalse($this->container()->hasGet('false'));
    }

    public function testPostData(): void
    {
        Container::$app->setPost(['key' => 'value']);
        $this->assertEquals('value', $this->container()->getPost('key'));
        $this->assertContains('value', $this->container()->getPost());
        $this->assertTrue($this->container()->hasPost('key'));
        $this->assertFalse($this->container()->hasPost('false'));
    }

    public function testServerData(): void
    {
        Container::$app->setServer(['key' => 'value']);
        $this->assertEquals('value', $this->container()->getServer('key'));
    }

    public function testSessionData(): void
    {
        Container::$app->setSession('key', 'value');
        Container::$app->setSession('subKey', 'value', 'subSet');
        Container::$app->setSession('increment', 'value', 'increment');
        $this->assertEquals('value', $this->container()->getSession('key'));
        $this->assertEquals('value', $this->container()->getSession('subKey', 'subSet'));
        $this->assertEquals('value', $this->container()->getSession('increment', '0'));
        $this->assertTrue($this->container()->hasSession('key'));
        $this->assertTrue($this->container()->hasSession('subKey', 'subSet'));
        $this->assertNull($this->container()->unsetSession('key'));
        $this->assertNull($this->container()->unsetSession('subKey', 'subSet'));
        $this->assertFalse($this->container()->hasSession('key'));
        $this->assertFalse($this->container()->hasSession('subKey', 'subSet'));
        $this->assertNull($this->container()->clearSession());
    }

    public function testCookieData(): void
    {
        Container::$app->setCookie('key', 'value');
        $this->assertEquals('value', $this->container()->getCookie('key'));
        $this->assertTrue($this->container()->hasCookie('key'));
        $this->assertFalse($this->container()->hasCookie('false'));
    }

    public function testFilesData(): void
    {
        Container::$app->setFiles(
            [
                'upload' => ['name' => ['img' => '41146.png']],
                'type'   => ['img' => 'image/png'],
            ]
        );

        $this->assertTrue($this->container()->isUploaded('img'));
        $this->assertTrue($this->container()->isFileType('img', 'image/png'));
        $this->assertEquals('41146.png', $this->container()->getUpload('img', 'name'));
    }
}
