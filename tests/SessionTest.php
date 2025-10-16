<?php declare(strict_types=1);

namespace Rudra\Container\Tests;

use PHPUnit\Framework\TestCase;
use Rudra\Exceptions\NotFoundException;
use Rudra\Container\Facades\{Cookie, Request, Response, Rudra, Session};

class SessionTest extends TestCase
{
    public function testSessionData(): void
    {
        $_SESSION = [];
        Rudra::session()->set("key", "value");
        Session::set("subKey", ["subSet" => "value"]);
        $this->assertEquals("value", Session::get("key"));
        $this->assertEquals("value", Session::get("subKey")["subSet"]);
        $this->assertTrue(Session::has("key"));
        Session::remove("key");
        $this->assertFalse(Session::has("key"));
        Session::clear();
        $this->assertTrue(count($_SESSION) === 0);
    }

    public function testSessionDataGetWrongKey(): void
    {
        $_SESSION = [];

        $this->expectException(NotFoundException::class);
        Session::get("wrongKey");
    }

    public function testSessionDataSetWithInvalidKey(): void
    {
        $this->expectException(\TypeError::class);
        Session::set([], "value");
    }
}
