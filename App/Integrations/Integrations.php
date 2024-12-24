<?php

namespace Humpff\Integrations;

use Humpff\App;
use Humpff\Shared\Component;
use Humpff\Integrations\Vite;

class Integrations extends Component
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