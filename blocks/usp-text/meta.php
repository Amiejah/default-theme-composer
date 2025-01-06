<?php

return [
    'name' => 'USP Text',
    'inner_blocks' => true,
    'set_allowed_inner_blocks' => [
        'core/heading',
        'core/paragraph',
        'core/buttons',
    ],
    'fields' => [
        [
            'type' => 'complex',
            'name' => 'usp_text_group',
            'label' => __('Group'),
            'set_header_template' =>  '<% if (name) { %> <%- name %> <% } %>',
            'set_layout' => 'tabbed-horizontal',
            'fields' => [
                [
                    'type' => 'text',
                    'name' => 'name',
                    'label' => __('heading'),
                ],
                [
                    'type' => 'textarea',
                    'name' => 'description',
                    'label' => __('Content'),
                ],
            ]
        ],
    ],
];


