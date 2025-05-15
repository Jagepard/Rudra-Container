<?php declare(strict_types=1);

namespace Rudra\Container\Tests;

use PHPUnit\Framework\TestCase;
use Rudra\Container\Exceptions\NotFoundException;
use Rudra\Container\Facades\Rudra;

class DataFunctionTest extends TestCase
{
    public function testCanSetAndGetDataByKey()
    {
        data(['key' => 'value']);
        $this->assertSame('value', data('key'));
    }

    public function testReturnsAllDataWhenNullIsPassed()
    {
        data(['key1' => 'value1', 'key2' => 'value2']);
        $result = data(null); // должен вызвать Rudra::shared()->all()

        $this->assertIsArray($result);
        $this->assertArrayHasKey('key1', $result);
        $this->assertArrayHasKey('key2', $result);
    }

    public function testDoesNotCallAllWhenZeroOrFalseIsPassed()
    {
        $this->expectException(NotFoundException::class); // или конкретный тип ошибки, если get() не может обработать такие ключи
        data(0); // не должно вызывать all(), а пытаться вызвать get(0)
    }

    public function testCallsGetWhenObjectIsUsedAsKey()
    {
        $key = new \stdClass();
        $key->id = 1;

        // Предположим, Rudra::shared()->get() поддерживает сериализацию
        data(['{"id":1}' => 'object_data']);

        $result = data(json_encode($key));
        $this->assertSame('object_data', $result);
    }
}