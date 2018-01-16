<?php
namespace Ling;

use PHPUnit\Framework\TestCase;

class commonTest extends TestCase
{
    public $hook_result;

    public function testConfig() {
        config(array('123' => '456'));
        $this->assertSame(config('123'), '456');
    }

    public function testEnvConfig() { // we need to add env test
        putenv('LING_ENV=dev');
        $this->assertSame(config('env.LING_ENV'), 'dev');
    }

    public function testHook() {
        hook('hook.hook_id', function ($hello, $world) {
            $this->hook_result =  $hello . ', ' . $world;
        });
        hook('hook.hook_id', array('Hello', 'world!'));
        $this->assertSame($this->hook_result, 'Hello, world!');
    }
}
