<?php

namespace Humpff\Blocks\Concerns;

use Illuminate\Support\Collection;


trait InteractsWithBlockConfig
{

    // protected function generateBlockJson(array $meta): array
    // {
    //     return [
    //         '$schema' => 'https://schemas.wp.org/trunk/block.json',
    //         'apiVersion' => 3,
    //         'name' => 'meta-box/' . $meta['id'],
    //         'title' => $meta['title'],
    //         'description' => $meta['description'],
    //         'style' => ['file:./' . $meta['id'] . '.css'],
    //         'category' => 'formatting',
    //         'icon' => 'format-quote',
    //         'keywords' => [$meta['id'], 'quote'],
    //         'supports' => ['anchor' => true],
    //         'attributes' => array_reduce($meta['fields'], function ($attributes, $field) {
    //             $attributes[$field['id']] = [
    //                 'type' => $field['type'] === 'single_image' ? 'object' : 'string',
    //                 'default' => $field['type'] === 'single_image' ? ['full_url' => 'https://example.com/photo.png'] : ''
    //             ];
    //             return $attributes;
    //         }, []),
    //         'render' => 'file:./' . $meta['id'] . '.php'
    //     ];
    // }


    protected function getFilesFromDirectory(string $directory): ?array
    {
        return humpff()->filesystem()->allFiles($directory);
    }

    protected function validateDirectory(string $directory): bool
    {
        return humpff()->filesystem()->missing($directory);
    }
}