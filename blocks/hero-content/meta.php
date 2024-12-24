<?php

return [
    '$schema' => 'https://schemas.wp.org/trunk/block.json',
    'apiVersion' => 3,
    'name' => 'hero-content',
    'meta' => [
        'title'       => __('Hero Content', 'default'),
        'id'          => 'hero-content',
        'description' => __('A custom hero content block', 'default'),
        'type'        => 'block',
        'icon'        => 'format-quote',
        'category'    => 'layout',
        'context'     => 'side',
        'supports'    => [
            'align'           => ['wide', 'full'],
            'customClassName' => true,
            'multiple'        => true,
            'reusable'        => true,
            'lock'            => false,
        ],
        'fields'      => [
            [
                'name' => 'Image',
                'id'   => 'image',
                'type' => 'single_image',
            ],
            [
                'id'   => 'title',
                'name' => 'Title',
            ],
            [
                'type' => 'textarea',
                'id'   => 'content',
                'name' => 'Content',
            ],
        ],
    ],
];