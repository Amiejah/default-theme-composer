<?php

$composer = get_template_directory() . '/vendor/autoload.php';

if (! file_exists($composer)) {

    wp_die(wp_kses_post(__('Error locating autoloader. Please run <code>composer install</code>.', 'fm')));
}

require $composer;

/*
 * Autoloader
 */
// spl_autoload_register(function ($class) {
//     if (strpos($class, 'Humpff\\') === 0) {

//         $path = preg_replace('/^Humpff/', __DIR__ , $class, 1);
//         $path = str_replace('\\', DIRECTORY_SEPARATOR, $path) . '.php';
//         if (file_exists($path)) {
//             require_once($path);
//         }
//     }
// });

if (! function_exists('humpff')) {
    function humpff(): Humpff\App
    {
        return Humpff\App::get();
    }
}

humpff();