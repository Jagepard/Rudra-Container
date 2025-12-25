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
