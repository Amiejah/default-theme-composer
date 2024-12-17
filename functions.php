<?php // phpcs:ignore PSR1.Files.SideEffects.FoundWithSymbols

define('HUMPFF_VERSION', '0.1.1');
define('HUMPFF_ROOT', str_replace(ABSPATH, '/', dirname(__DIR__, 1)));
define('HUMPFF_PATH', dirname(__DIR__, 1) );

define('HUMPFF_URI', home_url(HUMPFF_ROOT));

define('HUMPFF_HMR_HOST', 'http://localhost:5173');

define('HUMPFF_HMR_URI', HUMPFF_HMR_HOST . HUMPFF_ROOT);


define('HUMPFF_ASSETS_PATH', get_template_directory() . '/assets/build');
define('HUMPFF_ASSETS_URI', get_template_directory_uri() . '/assets/build');

define('HUMPFF_RESOURCES_PATH',  '/resources');
define('HUMPFF_RESOURCES_URI',  '/resources');

// load the bootstrap file
require_once get_template_directory() . '/library/bootstrap.php';
