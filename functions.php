<?php // phpcs:ignore PSR1.Files.SideEffects.FoundWithSymbols


//TODO: Fix the  issue with the constants
define('HUMPFF_VERSION', '0.1.1');
define('HUMPFF_ROOT', str_replace(ABSPATH, '/', dirname(__DIR__)));
define('HUMPFF_PATH', dirname(__DIR__, 1) );
define('HUMPFF_URI', home_url(HUMPFF_ROOT));
// define('HUMPFF_HMR_HOST', get_home_url() . ':5173');
define('HUMPFF_HMR_HOST', 'http://localhost:5173');


define('HUMPFF_HMR_URI', HUMPFF_HMR_HOST . HUMPFF_ROOT);

define('HUMPFF_ASSETS_PATH', get_template_directory() . '/assets/build');
define('HUMPFF_ASSETS_URI', get_template_directory_uri() . '/assets/build');
define('HUMPFF_RESOURCES_PATH', get_template_directory() . '/resources');
define('HUMPFF_RESOURCES_URI', get_template_directory_uri() . '/resources');

// echo '<pre>';
// var_dump('HUMPFF_ROOT', HUMPFF_ROOT . '<br>');
// var_dump('HUMPFF_PATH', HUMPFF_PATH . '<br>');
// var_dump('HUMPFF_URI', HUMPFF_URI . '<br>');
// var_dump('HUMPFF_HMR_HOST', HUMPFF_HMR_HOST . '<br>');
// var_dump('HUMPFF_HMR_URI', HUMPFF_HMR_URI . '<br>');
// var_dump('HUMPFF_ASSETS_PATH', HUMPFF_ASSETS_PATH . '<br>');
// var_dump('HUMPFF_ASSETS_URI', HUMPFF_ASSETS_URI . '<br>');
// echo '</pre>';

// load the bootstrap file
require_once get_template_directory() . '/library/bootstrap.php';
