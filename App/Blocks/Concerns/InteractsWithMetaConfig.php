<?php

namespace Humpff\Blocks\Concerns;

use Illuminate\Support\Collection;

trait InteractsWithMetaConfig
{
    protected Collection $metaFiles;

    protected function getMetaConfig(): Collection
    {
        return $this->metaFiles->map(fn($file) => humpff()->filesystem()->getRequire($file->getPathname()));
    }

    protected function setMetaFiles(): void
    {
        $this->metaFiles = $this->getMetaFiles();
    }

    protected function getMetaFiles(): Collection
    {

        if ($this->validateDirectory(humpff()->config()->get('blocks.path')) ) {
            return null;
        }

        $blockFiles = $this->getFilesFromDirectory(humpff()->config()->get('blocks.path'));

        return collect($blockFiles)
            ->filter(fn($file) => $file->getFileName() === 'meta.php');
    }
}