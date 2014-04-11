<?php

class TestController extends BaseController {
    public function test() {
        return 'Uraaa!';
    }
    
    public static function stTest() {
        return "Static test.";
    }
}