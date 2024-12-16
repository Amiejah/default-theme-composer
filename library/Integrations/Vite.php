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
     * @filter humpff/assets/resolver/url 1 2
     */
    public function url(string $url, string $path): string
    {
        return humpff()->config()->get('hmr.base') . "/{$path}";
    }
}