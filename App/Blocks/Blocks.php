<?php

namespace Humpff\Blocks;

use Humpff\Shared\Component;

class Blocks extends Component
{
    /**
     * @action init
     */
    public function init(): void
    {
        $this->getBlockJson();
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
        if (humpff()->filesystem()->missing($directory)) {
            return [];
        }

        $files = humpff()->filesystem()->allFiles($directory);

        $jsonFiles = humpff()->collections()::make($files)
            ->filter(fn($file) => $file->getExtension() === 'json')
            ->map(fn($file) => $file->getPathname())
            ->merge($jsonFiles)
            ->all();

        return $jsonFiles;
    }
}