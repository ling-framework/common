<?php

namespace Ling;

function session($key, $val = null) {
    $session = $_SESSION['LING_SESSION'];
    if (null === $val) {
        if ($session && isset($session[$key])) {
            return $session[$key];
        }
    } else {
        if (!$session) {
            $session = array();
        }
        $session[$key] = $val;
        $_SESSION['LING_SESSION'] = $session;
    }
    return null;
}

// we don't provide set_cookie, because there's built-in function: setcookie
function cookie($key) {
    return isset($_COOKIE[$key]) ? $_COOKIE[$key] : '';
}

function startsWith($haystack, $needle) {
    return !strncmp($haystack, $needle, strlen($needle));
}

function endsWith($haystack, $needle){
    return substr($haystack, -strlen($needle)) == $needle;
}

function getRealIPAddress(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    if ($ip === '::1') {
        $ip = '127.0.0.1';
    }
    return $ip;
}

// more utils here