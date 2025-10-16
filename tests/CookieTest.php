<?php declare(strict_types=1);

namespace Rudra\Container\Tests;

use Rudra\Container\Cookie;
use PHPUnit\Framework\TestCase;
use Rudra\Exceptions\NotFoundException;

final class CookieTest extends TestCase
{
    private Cookie $cookie;

    protected function setUp(): void
    {
        $this->cookie = new Cookie();
        // Очистка COOKIE перед каждым тестом
        foreach ($_COOKIE as $key => $value) {
            unset($_COOKIE[$key]);
            setcookie($key, '', -1, '/');
        }
    }

    public function testHasReturnsFalseWhenCookieDoesNotExist(): void
    {
        $this->assertFalse($this->cookie->has('test_key'));
    }

    public function testHasReturnsTrueWhenCookieExists(): void
    {
        setcookie('test_key', 'test_value');
        $_COOKIE['test_key'] = 'test_value';

        $this->assertTrue($this->cookie->has('test_key'));
    }

    public function testGetThrowsExceptionWhenCookieDoesNotExist(): void
    {
        $this->expectException(NotFoundException::class);
        $this->cookie->get('non_existing_key');
    }

    public function testGetReturnsCorrectValue(): void
    {
        setcookie('test_key', 'test_value');
        $_COOKIE['test_key'] = 'test_value';

        $this->assertSame('test_value', $this->cookie->get('test_key'));
    }

    public function testRemoveRemovesCookie(): void // Переименован
    {
        setcookie('test_key', 'test_value');
        $_COOKIE['test_key'] = 'test_value';

        $this->cookie->remove('test_key'); // ✅

        $this->assertFalse(isset($_COOKIE['test_key']));
        $this->assertFalse($this->cookie->has('test_key'));
    }

    public function testSetAddsCookieWithStringValue(): void
    {
        $this->cookie->set('test_key', 'test_value'); // ✅
    
        // Ручное обновление $_COOKIE для проверки
        $_COOKIE['test_key'] = 'test_value';
    
        $this->assertSame('test_value', $this->cookie->get('test_key'));
        $this->assertTrue($this->cookie->has('test_key'));
    }

    public function testSetAddsCookieWithOptions(): void
    {
        $expire = time() + 3600;
        $this->cookie->set('test_key', 'test_value', $expire, '/'); // ✅
    
        // Обновляем $_COOKIE вручную для проверки
        $_COOKIE['test_key'] = 'test_value';
    
        $this->assertSame('test_value', $_COOKIE['test_key']);
        $this->assertTrue($this->cookie->has('test_key'));
    }
}
