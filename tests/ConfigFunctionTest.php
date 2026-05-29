<?php declare(strict_types=1);

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
 * 
 * phpunit src/tests/ContainerTest --coverage-html src/tests/coverage-html
 */

namespace Rudra\Container\Tests;

use PHPUnit\Framework\TestCase;
use Rudra\Container\Facades\Rudra;
use Rudra\Exceptions\NotFoundException;

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

    public function testThrowsExceptionWhenSubKeyDoesNotExist(): void
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('Конфигурационный ключ "app.non_existing_key" не найден.');
        
        config('app', 'non_existing_key');
    }

    public function testThrowsExceptionWhenValueIsNotArray(): void
    {
        // Предположим, что 'version' — это строка, а не массив
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('Конфигурационный ключ "version.subkey" не найден.');
        
        config('version', 'subkey');
    }
}
