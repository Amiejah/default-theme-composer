<?php

return [
    '$schema' => 'https://schemas.wp.org/trunk/block.json',
    'apiVersion' => 3,
    'name' => 'hero-contents',
    'meta' => [
        'title'       => 'Hero Content',
        'id'          => 'hero-content',
        'description' => 'A custom hero content block',
        'type'        => 'block',
        'icon'        => 'format-quote',
        'category'    => 'km',
        'context'     => 'normal',
        'render_template' => get_template_directory() . '/blocks/hero-content/template.tmpl.php',
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