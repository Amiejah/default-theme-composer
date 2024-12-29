<?php

function load_template_functions() {
    require_once get_template_directory() . '/template-functions/general.php';
    require_once get_template_directory() . '/template-functions/menu.php';
}

add_action('after_setup_theme', 'load_template_functions');
