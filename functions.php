<?php

define('HUMPFF_VERSION', '0.1.1');

define('HUMPFF_ROOT', str_replace('/app/wordpress/', '', get_template_directory()) );

define('HUMPFF_PATH', dirname(__DIR__, 1) );

define('HUMPFF_URI', home_url(HUMPFF_ROOT));

define('HUMPFF_HMR_HOST', 'http://localhost:5173');

define('HUMPFF_HMR_URI', HUMPFF_HMR_HOST . '/' . HUMPFF_ROOT);

define('HUMPFF_ASSETS_PATH', get_template_directory() . '/assets/build');

define('HUMPFF_ASSETS_URI', get_template_directory_uri() . '/assets/build');

define('HUMPFF_RESOURCES_PATH',  '/resources');

define('HUMPFF_RESOURCES_URI',  '/resources');

define('DISALLOW_FILE_EDIT', true);

// load the bootstrap file -- DON'T REMOVE THIS FILE!
require_once get_template_directory() . '/App/bootstrap.php';

// Load the template specific functions
require_once get_template_directory() . '/template-functions/bootstrap.php';
