<?php

namespace Humpff\Wp;

use Carbon_Fields\Carbon_Fields;
use Illuminate\Support\Collection;

class Wp
{
    /**
     * @action init
     */
    public function init(): void
    {}

    /**
     * @action after_setup_theme
     */
    public function afterSetupTheme(): void
    {
        $this->registerCarbonFields();

        add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'custom-logo' );
		add_theme_support( 'customize-selective-refresh-widgets' );

        register_nav_menus([
            'primary' => __('Primary Menu'),
            'footer' => __('Footer Menu'),
        ]);

        add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			]
		);
    }

    /**
     * Register Carbon Fields
     */
    public function registerCarbonFields()
    {
        \Carbon_Fields\Carbon_Fields::boot();
    }

    /**
     * @action send_headers
     */
    public function registerWordPressHeaders(): void
    {
        header( 'Strict-Transport-Security: max-age=31536000' );
    }

    /**
     * @action admin_menu
     */
    public function updatePostsMenuIcon()
    {
        global $menu;

        foreach($menu as $key => $value) {
            if($value[0] === 'Posts') {
                $menu[$key][6] = 'dashicons-edit-page';
            }
        }
    }

    /**
     * @filter block_categories_all
     * @param array $categories
     */
    public function registerBlockCategory(array $categories): array
    {
        $categories[] = [
            'slug'  => 'km',
            'title' => 'Klein Media Blocks',
        ];

        return $categories;
    }

    /**
     * Get all post types
     * @param array $args
     * @param string $output
     */
    public function getPostTypes(array $args = [], string $output = 'objects')
    {
        $args = array_merge([
            'public' => true,
        ], $args);

        return collect(get_post_types($args, $output))
            ->map(fn($type) => $type->label)
            ->toArray();
    }

    /**
     * @filter pre_get_posts
     * @param \WP_Query $query
     */
    public function setSearchFilterByPostType( \WP_Query $query ) {
        if ( $query->is_search ) {
            if ( isset( $_GET['post_type'] ) ) {
                $query->set( 'post_type', $_GET['post_type'] );
            }
        }
        return $query;
    }

    /**
     * @filter body_class
     * @param array $classes
     */
    public function setBodyClassByPostType(array $classes): array
    {
        global $post;

        if (isset($post)) {
            $classes[] = "{$post->post_type}-{$post->post_name}";
        }

        return $classes;
    }

    /**
     * @action upload_mimes 1 1
     * @param array $mimes
     */
    public function addSVGsupport(array $mimes): array
    {
        $mimes['svg'] = 'image/svg+xml';

        return $mimes;
    }

    /**
     * @action login_head
     */
    public function customLoginLogo(): void
    {
        echo '<style type="text/css">
            h1 a {
                background-image:url('.get_template_directory_uri() . '/images/km-logo.png' .') !important; 
                background-size: contain !important;
                background-position: center !important;
                width: 100% !important;
            }
        </style>';
    }

    /**
     * @action login_headerurl
     */
    public function customLoginLogoUrl(): string
    {
        return 'https://kleinmedia.nl';
    }
}