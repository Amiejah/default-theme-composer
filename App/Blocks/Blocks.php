<?php

namespace Humpff\Blocks;

use Humpff\Blocks\Concerns\InteractsWithBlockConfig;
use Humpff\Blocks\Concerns\InteractsWithMetaConfig;
use Humpff\Shared\Component;
use Illuminate\Support\Collection;

class Blocks extends Component
{
    use InteractsWithBlockConfig;
    use InteractsWithMetaConfig;

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
}