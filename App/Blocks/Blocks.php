<?php

namespace Humpff\Blocks;

use Humpff\Shared\Component;
use Illuminate\Filesystem\Filesystem;

class Blocks extends Component
{

    private Filesystem $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @action init
     */
    public function init(): void
    {
        $this->getBlockJson();
    }

    protected function getBlockJson()
    {
        $blocks = [];

        foreach ($this->getJsonFiles(humpff()->config()->get('blocks.path')) as $file) {
            $blocks[] = json_decode(humpff()->filesystem()->get($file), true);
        }
        
        dd(collect($blocks));

        return $blocks;
    }

    protected function getJsonFiles(string $directory): array
    {
        $jsonFiles = [];
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory));

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'json') {
                $jsonFiles[] = $file->getPathname();
            }
        }

        return $jsonFiles;
    }
}