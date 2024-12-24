<?php

namespace Humpff\Blocks\Concerns;

trait InteractsWithBlockConfig
{
    protected static function defaultBlocksJson(): array
    {
        return [
            '$schema' => 'https://schemas.wp.org/trunk/block.json',
            'apiVersion' => 3,
            'style' => [],
            'render' => null,
        ];
    }

    protected function generateBlockJson(array $meta): array
    {
        return [
            '$schema' => 'https://schemas.wp.org/trunk/block.json',
            'apiVersion' => 3,
            'name' => 'meta-box/' . $meta['id'],
            'title' => $meta['title'],
            'description' => $meta['description'],
            'style' => ['file:./' . $meta['id'] . '.css'],
            'category' => 'formatting',
            'icon' => 'format-quote',
            'keywords' => [$meta['id'], 'quote'],
            'supports' => ['anchor' => true],
            'attributes' => array_reduce($meta['fields'], function ($attributes, $field) {
                $attributes[$field['id']] = [
                    'type' => $field['type'] === 'single_image' ? 'object' : 'string',
                    'default' => $field['type'] === 'single_image' ? ['full_url' => 'https://example.com/photo.png'] : ''
                ];
                return $attributes;
            }, []),
            'render' => 'file:./' . $meta['id'] . '.php'
        ];
    }
}