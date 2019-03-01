<?php
return [
    'backend' => [
        'per_page' => [
            'default' => 20,
            'export_csv'=>20,
            'admin' => 5,
        ],
        'max_page' => [
            'default' => 10,
            'admin' => 110,
        ]
    ],
    'frontend' => [
        'per_page' => [
            'default' => 20,
            'admin' => 10,
        ],
        'max_page' => [
            'default' => 10,
            'admin' => 10,
        ]
    ],
    'api' => [
        'per_page' => [
            'default' => 20,
            'admin' => 10,
        ],
        'max_page' => [
            'default' => 10,
            'admin' => 10,
        ]
    ],
];
