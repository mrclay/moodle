<?php

if (! defined('COE_MOODLE_AUTOLOADING')) {
    spl_autoload_register(function ($class) {
        if (0 !== strpos($class, 'Coe\\Moodle')) {
            return;
        }
        $file = __DIR__ . '/lib/' . strtr($class, '_\\', '//') . '.php';
        is_file($file) && (require $file);
    });
    define('COE_MOODLE_AUTOLOADING', true);
}
