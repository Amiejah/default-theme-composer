<?php

//TODO: Fix the  issue with the constants
define('HUMPFF_VERSION', '0.0.1');
define('HUMPFF_ROOT', str_replace(ABSPATH, '/', dirname(__DIR__, 1)));
define('HUMPFF_PATH', dirname(__DIR__, 1));

define('HUMPFF_URI', home_url(HUMPFF_ROOT));
define('HUMPFF_HMR_HOST', 'http://localhost:5173');
define('HUMPFF_HMR_URI', HUMPFF_HMR_HOST . HUMPFF_ROOT);
define('HUMPFF_ASSETS_PATH', HUMPFF_PATH . '/default-wp-theme/assets/build');
define('HUMPFF_ASSETS_URI', HUMPFF_URI . '/default-wp-theme/assets/build');



require_once get_template_directory() . '/library/bootstrap.php';
