<?php

return [
    'name' => 'USP Banner',
    'inner_blocks' => true,
    'set_allowed_inner_blocks' => [
        'core/heading',
        'core/paragraph',
        'core/buttons',
    ],
    'fields' => [
        [
            'type' => 'text',
            'name' => 'heading',
            'label' => __('Block Heading'),
        ],
        [
            'type' => 'color',
            'name' => 'background_color',   
            'label' => __('Background Color'),
        ]
    ],
];


