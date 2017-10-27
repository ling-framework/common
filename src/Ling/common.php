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

        return (isset($CONFIG[$key])) ? $CONFIG[$key] : $default;
    }
}

if (!function_exists('hook')) {
    function hook($hook_id, $args) {
        $hooks = config($hook_id);
        if ($hooks && is_array($args)) {
            foreach ($hooks as $hook) {
                call_user_func_array($hook, $args);
                //$hook(...$args); // PHP 5.6+
            } 
        } else if (is_callable($args)){ // save to hook
            if (!$hooks) $hooks = [];
            array_push($hooks, $args);
            config([$hook_id => $hooks]);
        }
    }
}

if (!function_exists('session')) {
    function session($key, $val = null) {
        $session = $_SESSION["LING_SESSION"];
        if (isNull($val)) {
            if ($session && isset($session[$key])) return $session[$key];
        } else {
            if (!$session) $session = array();
            $session[$key] = $val;
            $_SESSION["LING_SESSION"] = $session;
        } 
        return null;
    }
}

