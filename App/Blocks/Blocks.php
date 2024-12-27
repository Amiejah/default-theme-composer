<?php

namespace Humpff\Blocks;

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;
use Humpff\Blocks\Concerns\InteractsWithBlockConfig;
use Humpff\Blocks\Concerns\InteractsWithCarbonFields;
use Humpff\Blocks\Concerns\InteractsWithMetaConfig;
use Humpff\Shared\Component;
use Illuminate\Support\Collection;

class Blocks extends Component
{
    use InteractsWithBlockConfig;
    use InteractsWithMetaConfig;
    use InteractsWithCarbonFields;

    /**
     * @action init
     */
    public function init(): void
    {
        $this->setMetaFiles();
        $this->registerMetaboxBlock();
    }

    public function registerBlocks(): Collection
    {
        return $this->getMetaConfig()->map(function ( $block ) {
            return $block['meta'];
        });
    }

    public function registerMetaboxBlock(): void
    {
        add_filter('rwmb_meta_boxes', [
            $this, 'registerBlocks'
        ]);
    }

    /**
     * @action carbon_fields_register_fields
     */
    public function registerThemeOptionsFields()
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
                            ->add_options($this->socialOptions())
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
            ->add_tab(__('Which types should be activated'), [
                Field::make('multiselect', 'selected_custom_posts_types', __('Selected post types'))
                    ->add_options($this->carbonSelectedPostTypes())
                    ->set_required(true),
            ]);

    }

}