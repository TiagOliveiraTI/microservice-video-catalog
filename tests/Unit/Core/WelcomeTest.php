<?php

namespace Tests\Unit\Core;

use Core\Welcome;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Welcome::class)]
class WelcomeTest extends TestCase
{
    public function testShouldReturnHello(): void
    {
        $welcome = new Welcome();

        $response = $welcome->sayHello();

        $this->assertEquals('Hello!', $response);
    }
}
