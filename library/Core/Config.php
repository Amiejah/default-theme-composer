<?php

namespace Humpff\Core;

class Config
{
    private array $config = [];

    public function __construct()
    {
        
        $this->config = [
            'version' => wp_get_environment_type() === 'development' ? time() : HUMPFF_VERSION,
            'env' => [
                'type' => wp_get_environment_type(),
                'mode' => false === strpos(HUMPFF_PATH, ABSPATH . 'wp-content/plugins') ? 'theme' : 'plugin',
            ],
            'hmr' => [
                'uri' => HUMPFF_HMR_HOST,
                'client' => HUMPFF_HMR_URI . '/@vite/client',
                // 'base' => str_replace(home_url(), HUMPFF_HMR_HOST, HUMPFF_RESOURCES_URI),
                'sources' => HUMPFF_HMR_URI . '/resources',
                // 'active' => wp_get_environment_type() === 'development' && ! is_wp_error(wp_remote_get(HUMPFF_HMR_URI)),
                'active' => wp_get_environment_type() === 'development',

            ],
            'manifest' => [
                'path' => HUMPFF_ASSETS_PATH . '/manifest.json',
            ],
            'cache' => [
                'path' => wp_upload_dir()['basedir'] . '/cache/humpff',
            ],
            'resources' => [
                'path' => HUMPFF_PATH . '/resources',
            ],
            'views' => [
                'path' => HUMPFF_PATH . '/resources/views',
            ],
        ];
    }

    public function get(string $key): mixed
    {
        $value = $this->config;

        foreach( explode('.', $key) as $key) {
            if (isset($value[$key])) {
                $value = $value[$key];
            } else {
                return null;
            }
        }

        return $value;
    }

    public function isTheme(): bool
    {
        return 'theme' === $this->get('env.mode');
    }

    public function isPlugin(): bool
    {
        return 'plugin' === $this->get('env.mode');
    }
}