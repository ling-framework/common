<?php
namespace Ling;

use PHPUnit\Framework\TestCase;

class commonTest extends TestCase
{
    public $hook_result;

    public function testConfig() {
        config(['123' => '456']);
        $this->assertSame(config('123'), '456');
    }
    
    public function testHook() {
        hook('hook.hook_id', function ($hello, $world) {
            $this->hook_result =  $hello . ', ' . $world;
        });
        hook('hook.hook_id', ['Hello', 'world!']);
        $this->assertSame($this->hook_result, 'Hello, world!');
    }
}
