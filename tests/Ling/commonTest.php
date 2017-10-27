<?php
namespace Ling;

use PHPUnit\Framework\TestCase;
use function Ling\config as config;
use function Ling\hook as hook;

class commonTest extends TestCase
{
    public $hook_result;

    public function testConfig() {
        config(["123" => "456"]);
        $this->assertTrue(config("123") === "456");
    }
    
    public function testHook() {
        hook("hook.hook_id", function ($hello, $world) {
            $this->hook_result =  $hello . ", " . $world;
        });
        hook("hook.hook_id", ["Hello", "world!"]);
        $this->assertTrue($this->hook_result == "Hello, world!");
    }
}
