<?php

use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;
use Rudra\IContainer;
use Rudra\Container;

class ContainerTraitTest extends PHPUnit_Framework_TestCase
{

    protected $stub;

    protected function setUp()
    {
        Container::app()->setBinding(IContainer::class, Container::$app);

        $app = [
            'contracts' => [
                IContainer::class => Container::$app
            ],

            'services' => [
                'validation' => ['ClassWithoutConstructor'],
                'redirect'   => ['ClassWithoutParameters'],
                'db'         => ['ClassWithDefaultParameters', ['param' => '123']],
            ]
        ];

        Container::$app->setServices($app);

        $this->stub = new ClassWithContainerTrait(Container::$app);
    }

    public function testValidation()
    {
        $this->assertInstanceOf(ClassWithoutConstructor::class, $this->getStub()->validation());
    }

    public function testRedirect()
    {
        $this->assertInstanceOf(ClassWithoutParameters::class, $this->getStub()->redirect());
    }

    public function testDb()
    {
        $this->assertInstanceOf(ClassWithDefaultParameters::class, $this->getStub()->db());
    }

    public function testNew()
    {
        $newClassWithoutConstructor = $this->getStub()->new('ClassWithoutConstructor');
        $this->assertInstanceOf('ClassWithoutConstructor', $newClassWithoutConstructor);
    }

    public function testSetPagination()
    {
        $this->getMockBuilder('Rudra\Pagination')->getMock();
        $this->getStub()->setPagination(['id' => 1]);
        $this->assertInstanceOf('Rudra\Pagination', $this->getStub()->pagination());
    }

    public function testPost()
    {
        Container::$app->setPost(['key' => 'value']);
        $this->assertEquals('value', $this->getStub()->post('key'));
    }

    public function testSessionData()
    {
        $this->getStub()->setSession('key', 'value');
        $this->getStub()->setSession('subKey', 'value', 'subSet');
        $this->getStub()->setSession('increment', 'value', 'increment');
        $this->assertEquals('value', Container::$app->getSession('key'));
        $this->assertEquals('value', Container::$app->getSession('subKey', 'subSet'));
        $this->assertEquals('value', Container::$app->getSession('increment', 0));
        $this->assertNull($this->getStub()->unsetSession('key'));
        $this->assertNull($this->getStub()->unsetSession('subKey', 'subSet'));
        $this->assertFalse(Container::$app->hasSession('key'));
        $this->assertFalse(Container::$app->hasSession('subKey', 'subSet'));
    }

    /**
     * @return mixed
     */
    public function getStub()
    {
        return $this->stub;
    }
}