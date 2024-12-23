<?php

namespace Humpff\Integrations;

class Vite
{
    /**
     * @action wp_head 1
     */
    public function client(): void
    {
        echo '<script type="module" src="' . humpff()->config()->get('hmr.client') . '"></script>';
    }

    /**
     * @filter humpff_assets_resolver_url 1 2
     */
    public function url(string $url, string $path): string
    {
        return humpff()->config()->get('hmr.sources') . "/{$path}";
    }
}