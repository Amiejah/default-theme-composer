<?php

define('HUMPFF_VERSION', '0.0.1');

define('HUMPFF_ROOT', str_replace(ABSPATH, '/', get_template_directory()));

define('HUMPFF_PATH',get_template_directory());
define('HUMPFF_URI', home_url());
define('HUMPFF_HMR_HOST', 'http://localhost:5173');
define('HUMPFF_HMR_URI', HUMPFF_HMR_HOST . HUMPFF_ROOT);
define('HUMPFF_ASSETS_PATH', HUMPFF_PATH . '/assets/build');
define('HUMPFF_ASSETS_URI', HUMPFF_URI . '/assets/build');

require_once get_template_directory() . '/library/bootstrap.php';
