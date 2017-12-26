<?php

namespace Ling;

if (!function_exists('config')) {

    $GLOBALS['LING_CONFIG'] = array();

    function config($key, $default = null) {
        $CONFIG = $GLOBALS['LING_CONFIG'];

        if (is_array($key)) {
            foreach($key as $k => $v) {
                $CONFIG[$k] = $v;
            }
            $GLOBALS['LING_CONFIG'] = $CONFIG;
            return null;
        }

        return isset($CONFIG[$key]) ? $CONFIG[$key] : $default;
    }
}

if (!function_exists('hook')) {

    function hook($hook_id, $args = array()) {
        /** @var array $hooks */
        $hooks = config($hook_id);
        if ($hooks && is_array($args)) {
            foreach ($hooks as $hook) {
                call_user_func_array($hook, $args);
                //$hook(...$args); // PHP 5.6+
            } 
        } else if (is_callable($args)){ // save to hook
            if (!$hooks) {
                $hooks = array();
            }
            $hooks[] = $args;
            config(array($hook_id => $hooks));
        }
    }
}

if (!function_exists('session')) {
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
}

if (!function_exists('cookie')) {
    // we don't provide set_cookie, because there's built-in function setcookie
    function cookie($key) {
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : '';
    }
}