<?php

namespace Humpff;

use Humpff\Assets\Assets;
use Humpff\Blocks\Blocks;
use Humpff\Core\Config;
use Humpff\Core\Hooks;
use Humpff\Integrations\Integrations;
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

    private static ?App $instance = null;

    private function __construct()
    {
        $this->assets = self::init(new Assets());
        $this->config = self::init(new Config());
        $this->filesystem = self::init(new Filesystem());
        $this->collections = self::init(new Collection());
        $this->integrations = self::init(new Integrations());
        $this->blocks = self::init(new Blocks($this->filesystem));
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