<?php

return [
    'name' => 'Hero Content',
    'inner_blocks' => true,
    'set_allowed_inner_blocks' => [
        'core/heading',
        'core/paragraph',
        'core/image',
    ],
    'fields' => [
        [
            'type' => 'text',
            'name' => 'heading',
            'label' => 'Block Heading',
        ],
        [
            'type' => 'textarea',
            'name' => 'content',
            'label' => 'Block Content',
        ],
        [
            'type' => 'image',
            'name' => 'image',
            'label' => 'Block Image',
        ],
    ],
];


