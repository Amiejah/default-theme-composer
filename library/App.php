<?php

namespace Humpff;

use Humpff\Assets\Assets;
use Humpff\Core\Config;
use Humpff\Core\Hooks;

class App
{
    private Assets $assets;

    private Config $config;

    private static ?App $instance = null;

    private function __construct()
    {
        $this->assets = self::init(new Assets());
        $this->config = self::init(new Config());
    }

    public function assets(): Assets
    {
        return $this->assets;
    }

    public function config(): Config
    {
        return $this->config;
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