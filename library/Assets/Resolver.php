<?php

namespace Humpff\Assets;

trait Resolver
{
    private array $manifest = [];

    /**
     * @action wp_enqueue_scripts 1
     */
    public function load(): void
    {
        $path = humpff()->config()->get('manifest.path');

        
        if (empty($path) || ! file_exists($path)) {
            wp_die(__('Run <code>npm run build</code> in your application root!', 'humpff'));
        }

        $manifestContent = file_get_contents($path);

        if (false === $manifestContent) {
            wp_die(__('Unable to read the Vite manifest file.', 'humpff'));
        }

        $manifest = json_decode($manifestContent, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            wp_die(__('The Vite manifest file is not a valid JSON file.', 'humpff'));
        }

        $this->manifest = $manifest;
    }

    /**
     * Modify the script tag to use type="module" for HMR or production assets.
     *
     * @filter script_loader_tag 1 3
     */
    public function module(string $tag, string $handle, string $url): string
    {
        if (false !== strpos($url, HUMPFF_HMR_HOST) || false !== strpos($url, HUMPFF_ASSETS_URI)) {
            $tag = str_replace('<script ', '<script type="module" ', $tag);
        }

        return $tag;
    }

    /**
     * Resolve an asset path to its URI based on the manifest.
     *
     * @param string $path The asset path relative to the `resources/` directory.
     * @return string The resolved URI for the asset.
     */
    private function resolve(string $path): string
    {
        $relativePath = "resources/{$path}";

        if (!isset($this->manifest[$relativePath])) {
            do_action('humpff/assets/resolver/missing', $path);
            return '';
        }

        $url = HUMPFF_ASSETS_URI . '/' . $this->manifest[$relativePath]['file'];
        
        var_dump($url);
        
        return apply_filters('humpff/assets/resolver/url', $url, $path);
    }
}