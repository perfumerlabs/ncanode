<?php

return [
    'gateway' => [
        'shared' => true,
        'class' => 'Project\\Gateway',
        'arguments' => ['#application', '#gateway.http', '#gateway.console']
    ],

    'ncanode' => [
        'shared' => true,
        'class' => 'Project\Service\Ncanode',
        'arguments' => [
            '@ncanode/host',
            '@ncanode/dummy'
        ],
    ],
];