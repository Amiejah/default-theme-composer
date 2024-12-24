<?php

namespace Humpff\Blocks;

use Humpff\Blocks\Concerns\InteractsWithBlockConfig;
use Humpff\Shared\Component;

class Blocks extends Component
{
    use InteractsWithBlockConfig;

    /**
     * @action init
     */
    public function init(): void
    {
        $this->getBlockJson();
        // $this->registerBlocks();
    }

    protected function getBlockJson(): array
    {
        $blocks = [];

        foreach ($this->getJsonFiles(humpff()->config()->get('blocks.path')) as $file) {
            $blocks[] = json_decode(humpff()->filesystem()->get($file), true);
        }

        return $blocks;
    }

    protected function getJsonFiles(string $directory, ?array $jsonFiles = []): array
    {
        $files = $this->getFilesFromDirectory($directory) ?: [];

        return collect($files)
            ->filter(fn($file) => $file->getExtension() === 'json')
            ->map(fn($file) => $file->getPathname())
            ->merge($jsonFiles)
            ->all();
    }

    protected function getFilesFromDirectory(string $directory): ?array
    {
        if (humpff()->filesystem()->missing($directory)) {
            return null;
        }

        return humpff()->filesystem()->allFiles($directory);
    }


    // protected function registerBlocks()
    // {
    //     register_block_type( 
    //         dirname(__FILE__) . '/blocks/hero-content'
    //     );
    // }

    /**
     * @action rwmb_meta_boxes
     */
    // public function registerMetaboxBlock( $metaboxes ) {
    //     $metaboxes[] = [];

    //     return $metaboxes;
    // }
}