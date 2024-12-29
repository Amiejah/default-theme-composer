<?php

namespace Humpff\Wp;

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;
use Humpff\Blocks\Concerns\InteractsWithCarbonFields;

class Wp
{
    use InteractsWithCarbonFields;

    public function init(): void {}

    /**
     * @action after_setup_theme
     */
    public function afterSetupTheme(): void
    {
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
     * @action after_setup_theme
     */
    public function addThemeOptions()
    {
        $basic_options_container = Container::make('theme_options', __('Theme Options'))
            ->set_page_menu_position(30)
            ->add_fields([
                // Field::make( 'header_scripts', 'crb_header_script', __( 'Header Script' ) ),
                // Field::make( 'footer_scripts', 'crb_footer_script', __( 'Footer Script' ) ),
            ]);

        Container::make( 'theme_options', __( 'Contact' ) )
            ->set_page_parent( $basic_options_container )
            ->add_tab(__('General'), [
            ])
            ->add_tab(__('Contact information'), [
                Field::make('text', 'phone', __('Phone'))
                    ->set_attribute('placeholder', '+1 123 456 7890'),
            ]);

        Container::make( 'theme_options', __( 'Social Links' ) )
            ->set_page_parent( $basic_options_container )
            ->add_fields([
                Field::make('complex', 'social_links', __('Social Links'))
                    ->add_fields([
                        Field::make('select', 'icon', __('Select an icon'))
                            // ->add_options($this->socialOptions())
                            ->add_options([])
                            ->set_required(true),
                        Field::make('text', 'link', __('Link'))
                            ->set_attribute('placeholder', 'https://')
                            ->set_attribute('type', 'url'),
                    ]),
            ]);

        Container::make('theme_options', __('Scripts'))
            ->set_page_parent( $basic_options_container )
            ->add_fields([
                Field::make( 'header_scripts', 'header_script', __( 'Header Scripts' ) ),
                Field::make( 'header_scripts', 'body_scripts', __( 'Body Scripts' ) )
                    ->set_hook_name('wp_body_open'),
                Field::make( 'footer_scripts', 'footer_script', __( 'Footer Scripts' ) ),
            ]);

        Container::make( 'theme_options', __( 'Configuration' ) )
            ->set_page_parent( $basic_options_container )
            ->add_tab(__('General'), [
                Field::make('multiselect', 'disabled_types', __('Disable post types'))
                    ->add_options($this->defaultPostTypes()),
            ]);
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
}