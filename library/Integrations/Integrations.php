<?php

namespace Humpff\Integrations;

use Humpff\App;

class Integrations
{
    public function init(): void
    {
    
        if (humpff()->config()->get('hmr.active')) {
            App::init(new Vite());
        }
    }
}