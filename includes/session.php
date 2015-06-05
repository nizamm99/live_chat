<?php

session_start();

class Session {
    
    function __construct() {

    }

    public function setSession($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function getSession($key) {
        return $_SESSION[$key];
    }
    
    public function setFlashSession($key, $value) {
        
    }

}

$session = new Session();
