<?php

namespace Ling;
use function Ling\startsWith;

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

    if (startsWith($key, 'env.')) { // if some config starts with env, get variable from env
        return getenv(substr($key, 4));
    }
    return isset($CONFIG[$key]) ? $CONFIG[$key] : $default;
}

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

