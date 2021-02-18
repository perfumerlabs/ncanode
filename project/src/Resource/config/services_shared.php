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

    'ncanode.domain.signature' => [
        'shared' => true,
        'class' => 'Ncanode\\Domain\\SignatureDomain',
    ],

    'ncanode.repository.signature' => [
        'shared' => true,
        'class' => 'Ncanode\\Repository\\SignatureRepository',
    ],
];