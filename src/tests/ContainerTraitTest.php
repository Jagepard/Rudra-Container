<?php

/**
 * Date: 17.02.17
 * Time: 13:23
 *
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2016, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 *
 *  phpunit src/tests/ContainerTraitTest --coverage-html src/tests/coverage-html
 */


use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;
use Rudra\ContainerInterface;
use Rudra\Container;


/**
 * Class ContainerTraitTest
 */
class ContainerTraitTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var ClassWithContainerTrait
     */
    protected $stub;

    protected function setUp(): void
    {
        Container::app()->setBinding(ContainerInterface::class, Container::$app);

        $app = [
            'contracts' => [
                ContainerInterface::class => Container::$app
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

    public function testValidation(): void
    {
        $this->assertInstanceOf(ClassWithoutConstructor::class, $this->getStub()->validation());
    }

    public function testRedirect(): void
    {
        $this->assertInstanceOf(ClassWithoutParameters::class, $this->getStub()->redirect());
    }

    public function testDb(): void
    {
        $this->assertInstanceOf(ClassWithDefaultParameters::class, $this->getStub()->db());
    }

    public function testNew(): void
    {
        $newClassWithoutConstructor = $this->getStub()->new('ClassWithoutConstructor');
        $this->assertInstanceOf('ClassWithoutConstructor', $newClassWithoutConstructor);
    }

    public function testSetPagination(): void
    {
        $this->getMockBuilder('Rudra\Pagination')->getMock();
        $this->getStub()->setPagination(['id' => 1]);
        $this->assertInstanceOf('Rudra\Pagination', $this->getStub()->pagination());
    }

    public function testPost(): void
    {
        Container::$app->setPost(['key' => 'value']);
        $this->assertEquals('value', $this->getStub()->post('key'));
    }

    public function testPut(): void
    {
        Container::$app->setPut(['key' => 'value']);
        $this->assertTrue($this->getStub()->container()->hasPut('key'));
        $this->assertEquals('value', $this->getStub()->container()->getPut('key'));
    }

    public function testPatch(): void
    {
        Container::$app->setPatch(['key' => 'value']);
        $this->assertTrue($this->getStub()->container()->hasPatch('key'));
        $this->assertEquals('value', $this->getStub()->container()->getPatch('key'));
    }

    public function testDelete(): void
    {
        Container::$app->setDelete(['key' => 'value']);
        $this->assertTrue($this->getStub()->container()->hasDelete('key'));
        $this->assertEquals('value', $this->getStub()->container()->getDelete('key'));
    }

    public function testSessionData(): void
    {
        $this->getStub()->setSession('key', 'value');
        $this->getStub()->setSession('subKey', 'value', 'subSet');
        $this->getStub()->setSession('increment', 'value', 'increment');
        $this->assertEquals('value', Container::$app->getSession('key'));
        $this->assertEquals('value', Container::$app->getSession('subKey', 'subSet'));
        $this->assertEquals('value', Container::$app->getSession('increment', '0'));
        $this->assertNull($this->getStub()->unsetSession('key'));
        $this->assertNull($this->getStub()->unsetSession('subKey', 'subSet'));
        $this->assertFalse(Container::$app->hasSession('key'));
        $this->assertFalse(Container::$app->hasSession('subKey', 'subSet'));
    }

    public function testConfig(): void
    {
        Container::$app->setConfig(['key' => ['subKey' => 'value']]);

        $this->assertInternalType('array', Container::$app->config('key'));
        $this->assertEquals('value', Container::$app->config('key', 'subKey'));
    }

    /**
     * @runInSeparateProcess
     */
//    public function testJsonResponse(): void
//    {
//        $data = ['key' => ['subKey' => 'value']];
//
//        ob_start();
//        Container::$app->jsonResponse($data);
//        $json = ob_get_clean();
//
//        $this->assertEquals(json_encode($data), $json);
//    }

    /**
     * @return ClassWithContainerTrait
     */
    public function getStub(): ClassWithContainerTrait
    {
        return $this->stub;
    }
}
