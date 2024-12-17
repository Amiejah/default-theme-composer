<?php

/*
 * Autoloader
 */
spl_autoload_register(function ($class) {
    if (strpos($class, 'Humpff\\') === 0) {

        $path = preg_replace('/^Humpff/', __DIR__ , $class, 1);
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path) . '.php';
        if (file_exists($path)) {
            require_once($path);
        }
    }
});

if (! function_exists('humpff')) {
    function humpff(): Humpff\App
    {
        return Humpff\App::get();
    }
}

humpff();