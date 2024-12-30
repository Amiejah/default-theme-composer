<?php

namespace Humpff\Blocks\Concerns;

use Illuminate\Support\Collection;

trait InteractsWithMetaConfig
{
    protected Collection $metaFiles;
    protected string $directoryPath;

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
        $this->setDirectoryPath(humpff()->config()->get('blocks.path'));

        if (!$this->validateDirectory($this->directoryPath) ) {
            return [];
        }

        $blockFiles = $this->getFilesFromDirectory($this->directoryPath);

        return collect($blockFiles)
            ->filter(fn($file) => $file->getFileName() === 'meta.php');
    }

    protected function getDirectoryPath(): ?string
    {
        return $this->directoryPath;
    }

    protected function setDirectoryPath(?string $path): void
    {
        $this->directoryPath = $path;
    }

    protected function getFilesFromDirectory(string $directory): ?array
    {
        return humpff()->filesystem()->allFiles($directory);
    }

    protected function validateDirectory(string $directory): bool
    {
        return humpff()->filesystem()->exists($directory);
    }
}