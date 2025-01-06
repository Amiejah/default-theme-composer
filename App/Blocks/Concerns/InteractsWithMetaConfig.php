<?php

namespace Humpff\Blocks\Concerns;

use Carbon_Fields\Field\Field;
use Illuminate\Support\Arr;
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

    public function generateFields($fields): array
    {
        return collect($fields)->map(function ($item) {
            $field = Field::make($item['type'], $item['name'])
                ->set_label($item['label']);
                
            #TODO: For now this check if fine, but when more is added we need to refactor this
            if (Arr::has($item, 'fields')) {
                $field->add_fields('fields', 
                    $this->generateFields($item['fields'])
                );

                $field->set_header_template($item['set_header_template'] ?? null);
                $field->set_layout($item['set_layout'] ?? null);
            }

            return $field;
        })->toArray();
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