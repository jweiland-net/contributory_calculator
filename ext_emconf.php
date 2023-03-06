<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Contributory Calculator',
    'description' => 'Extension to calculate contributories in the frontend.',
    'category' => 'plugin',
    'author' => 'Stefan Froemken',
    'author_email' => 'projects@jweiland.net',
    'state' => 'stable',
    'version' => '5.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.36-11.5.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
