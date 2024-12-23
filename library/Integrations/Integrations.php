<?php

namespace Humpff\Integrations;

use Humpff\App;
use Humpff\Integrations\Vite;

class Integrations
{
    /**
     * @action init
     */
    public function init(): void
    {
        if (humpff()->config()->get('hmr.active')) {
        
            App::init(new Vite());
        }
    }
}