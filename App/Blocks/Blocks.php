<?php

namespace Humpff\Blocks;

use Humpff\Blocks\Concerns\InteractsWithBlockConfig;
use Humpff\Blocks\Concerns\InteractsWithMetaConfig;
use Humpff\Shared\Component;
use Illuminate\Support\Collection;

class Blocks extends Component
{
    use InteractsWithBlockConfig;
    use InteractsWithMetaConfig;

    /**
     * @action init
     */
    public function init(): void
    {
        $this->setMetaFiles();
        $this->registerMetaboxBlock();
    }

    public function registerBlocks(): Collection
    {
        return $this->getMetaConfig()->map(function ( $block ) {
            return $block['meta'];
        });
    }

    // protected function getBlockJson(): array
    // {
    //     $blocks = [];

    //     foreach ($this->getJsonFiles(humpff()->config()->get('blocks.path')) as $file) {
    //         $blocks[] = json_decode(humpff()->filesystem()->get($file), true);
    //     }

    //     return $blocks;
    // }

    // protected function getJsonFiles(string $directory, ?array $jsonFiles = []): array
    // {
    //     $files = $this->getFilesFromDirectory($directory) ?: [];

    //     return collect($files)
    //         ->filter(fn($file) => $file->getExtension() === 'json')
    //         ->map(fn($file) => $file->getPathname())
    //         ->merge($jsonFiles)
    //         ->all();
    // }


    public function registerMetaboxBlock(): void
    {
        add_filter('rwmb_meta_boxes', [
            $this, 'registerBlocks'
        ]);
    }
}