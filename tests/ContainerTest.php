<?php declare(strict_types=1);

namespace Rudra\Container\Tests;

use Rudra\Container\Container;
use PHPUnit\Framework\TestCase;
use Rudra\Container\Exceptions\NotFoundException;

class ContainerTest extends TestCase
{
    private Container $container;

    protected function setUp(): void
    {
        $this->container = new Container();
    }

    public function testSetAndGetSingleValue(): void
    {
        $this->container->set(['key1' => 'value1']);
        $this->assertEquals('value1', $this->container->get('key1'));
    }

    public function testSetMergesDataCorrectly(): void
    {
        $this->container->set(['key1' => 'value1']);
        $this->container->set(['key2' => 'value2']);

        $this->assertEquals([
            'key1' => 'value1',
            'key2' => 'value2'
        ], $this->container->all());
    }

    public function testOverwritingExistingKeyWithSet(): void
    {
        $this->container->set(['key1' => 'old_value']);
        $this->container->set(['key1' => 'new_value']);

        $this->assertEquals('new_value', $this->container->get('key1'));
    }

    public function testHasKeyReturnsTrueForExistingKey(): void
    {
        $this->container->set(['key1' => 'value1']);
        $this->assertTrue($this->container->has('key1'));
    }

    public function testHasKeyReturnsFalseForMissingKey(): void
    {
        $this->assertFalse($this->container->has('missing_key'));
    }

    public function testGetThrowsNotFoundExceptionOnMissingKey(): void
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('Identifier "missing_key" is not found.');

        $this->container->get('missing_key');
    }

    public function testAllReturnsFullDataArray(): void
    {
        $this->container->set([
            'key1' => 'value1',
            'key2' => 'value2'
        ]);

        $this->assertEquals([
            'key1' => 'value1',
            'key2' => 'value2'
        ], $this->container->all());
    }
}
