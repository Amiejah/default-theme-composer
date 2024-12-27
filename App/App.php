<?php

namespace Humpff;

use Humpff\Assets\Assets;
use Humpff\Blocks\Blocks;
use Humpff\Core\Config;
use Humpff\Core\Hooks;
use Humpff\Integrations\Integrations;
use Humpff\Posts\Posts;
use Humpff\Wp\Wp;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;

class App
{
    private Assets $assets;

    private Config $config;

    private Filesystem $filesystem;

    private Collection $collections;

    private Integrations $integrations;

    private Blocks $blocks;

    private Posts $posts;

    private Wp $wp;

    private static ?App $instance = null;

    private function __construct()
    {
        $this->wp = self::init(new Wp());
        $this->assets = self::init(new Assets());
        $this->config = self::init(new Config());
        $this->filesystem = self::init(new Filesystem());
        $this->collections = self::init(new Collection());
        $this->integrations = self::init(new Integrations());
        $this->posts = self::init(new Posts());
        $this->blocks = self::init(new Blocks());
    }

    public function wp(): Wp
    {
        return $this->wp;
    }

    public function assets(): Assets
    {
        return $this->assets;
    }

    public function config(): Config
    {
        return $this->config;
    }

    public function filesystem(): Filesystem
    {
        return $this->filesystem;
    }

    public function collections(): Collection
    {
        return $this->collections;
    }

    public function posts(): Posts
    {
        return $this->posts;
    }

    public function blocks(): Blocks
    {
        return $this->blocks;
    }

    public function integrations(): Integrations
    {
        return $this->integrations;
    }

    public static function get(): App
    {
        if (empty(self::$instance)) {
            self::$instance = new App();
        }
        return self::$instance;
    }

    public static function init(object $module): object
    {
        return Hooks::init($module);
    }
}