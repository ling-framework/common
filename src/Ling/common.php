<?php

namespace Ling;

$GLOBALS['LING_ENV'] = array();

function env($key, $default = null) {

    $ENV = $GLOBALS['LING_ENV'];

    if (is_array($key)) {
        foreach($key as $k => $v) {
            $ENV[$k] = $v;
        }
        $GLOBALS['LING_ENV'] = $ENV;
        return null;
    }

    if (!strncmp($key, 'env.', 4)) { //  get variable from env
        return getenv(substr($key, 4)) ?: $default;
    }
    return isset($ENV[$key]) ? $ENV[$key] : $default;
}

function hook($hook_id, $args = array()) {
    /** @var array $hooks */
    $hooks = env($hook_id);
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
        env(array($hook_id => $hooks));
    }
}

