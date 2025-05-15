<?php declare(strict_types=1);

namespace Rudra\Container\Tests;

use PHPUnit\Framework\TestCase;
use Rudra\Container\Facades\Rudra;

class ConfigFunctionTest extends TestCase
{
    protected function setUp(): void
    {
        Rudra::config()->set([
            'app' => [
                'name' => 'MyApp',
                'env' => 'dev'
            ],
            'version' => '1.0.0'
        ]);
    }

    public function testReturnsAllConfigWhenKeyIsNull()
    {
        $expected = Rudra::config()->all();
        $this->assertSame($expected, config(null));
    }

    public function testReturnsFullSectionWhenSubKeyNotProvided()
    {
        $section = Rudra::config()->get('app');
        $this->assertSame($section, config('app'));
    }

    public function testReturnsSubKeyWhenPresent()
    {
        $value = Rudra::config()->get('app')['name'] ?? null;
        $this->assertSame($value, config('app', 'name'));
    }

    public function testReturnsFalseWhenSubKeyDoesNotExist()
    {
        $this->assertFalse(config('app', 'non_existing_key'));
    }

    public function testReturnsFalseWhenValueIsNotArray()
    {
        // Предположим, что 'version' — это строка, а не массив
        $this->assertFalse(config('version', 'subkey'));
    }
}
