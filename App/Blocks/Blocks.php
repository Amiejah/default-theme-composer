<?php

namespace Humpff\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;
use Humpff\Blocks\Concerns\InteractsWithCarbonFields;
use Humpff\Blocks\Concerns\InteractsWithMetaConfig;
use Humpff\Shared\Component;

class Blocks extends Component
{
    use InteractsWithMetaConfig;
    use InteractsWithCarbonFields;

    /**
     * @action after_setup_theme
     */
    public function init(): void
    {
        $this->setMetaFiles();
        $this->installDefaultBlocks();
    }

    public function installDefaultBlocks()
    {
        return $this->getMetaConfig()->each(function ( $block )
        {
            Block::make($block['name'])
                ->add_fields(
                    collect($block['fields'])->map(function ($field) {
                        return Field::make($field['type'], $field['name'])
                            ->set_label($field['label']);
                    })->toArray()
                )
                ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) use ($block){
                    ?>
                        <div <?= get_block_wrapper_attributes(['class' => 'wp-block-wrapper']); ?>>
                            <?php require_once $this->getDirectoryPath() . '/' . sanitize_title($block['name']) . '/template.tmpl.php'; ?>
                        </div>
                    <?php
                });
        });
    }



    // public function registerMetaboxBlock(): void
    // {
    //     add_filter('rwmb_meta_boxes', [
    //         $this, 'registerBlocks'
    //     ]);
    // }

}