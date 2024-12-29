<?php

$composer = get_template_directory() . '/vendor/autoload.php';

if (! file_exists($composer)) {
    wp_die(wp_kses_post(__('Error locating autoloader. Please run <code>composer install</code>.', 'fm')));
}

require $composer;

if (!function_exists('crb_load')) {
    function crb_load()
    {
        \Carbon_Fields\Carbon_Fields::boot();
    }
    add_action('after_setup_theme', 'crb_load');
}

if (!function_exists('humpff')) {
    function humpff(): Humpff\App
    {
        return Humpff\App::get();
    }
    humpff();
}