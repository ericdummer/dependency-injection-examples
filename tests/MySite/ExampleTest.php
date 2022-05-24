<?php

namespace App;

use App\MySite\Example;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testPushAndPop(): void
    {
        $obj = new Example();
        $this->assertEquals("Hello, World!", $obj->helloWorld());
    }
}
