<?php

namespace Humpff\Assets;

use Humpff\Assets\Resolver;

class Assets
{
    use Resolver;

    /**
     * @action wp_enqueue_scripts
     */
    public function front(): void
    {
        
        wp_enqueue_style('theme', $this->resolve('styles/main.css'), [], humpff()->config()->get('version'));
        wp_enqueue_script('theme', $this->resolve('scripts/main.js'), [], humpff()->config()->get('version'), true);

    }

}