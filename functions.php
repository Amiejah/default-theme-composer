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

// load the bootstrap file
require_once get_template_directory() . '/App/bootstrap.php';


function humpff_register_blocks() {
    // Specify the path to the block.json's folder
    register_block_type( 
        dirname(__FILE__) . '/blocks/hero-content'
    );
}

add_action( 'init', 'humpff_register_blocks' );

add_filter( 'rwmb_meta_boxes', function( $meta_boxes ) {
    $meta_boxes[] = [
        'title'       => 'Hero Content',
        'id'          => 'hero-content',
        'description' => 'A custom hero content block',

        'type'        => 'block',

        // Block fields, must match block.json's attributes.
        'fields'      => [
            [
                'type' => 'single_image',
                'id'   => 'image',
                'name' => 'Image',
            ],
            [
                'id'   => 'title',
                'name' => 'Title',
            ],
            [
                'type' => 'textarea',
                'id'   => 'content',
                'name' => 'Content',
            ],
        ],
    ];
    return $meta_boxes;
} );