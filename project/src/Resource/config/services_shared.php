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
            '@ncanode/remote_url',
            '@ncanode/dummy'
        ],
    ],

    'ncanode.domain.signature' => [
        'shared' => true,
        'class' => 'Ncanode\\Domain\\SignatureDomain',
    ],

    'ncanode.domain.tag' => [
        'shared' => true,
        'class' => 'Ncanode\\Domain\\TagDomain',
    ],

    'ncanode.repository.signature' => [
        'shared' => true,
        'class' => 'Ncanode\\Repository\\SignatureRepository',
    ],

    'propel.connection_manager' => [
        'class' => 'Propel\\Runtime\\Connection\\ConnectionManagerSingle',
        'after' => function(\Perfumer\Component\Container\Container $container, \Propel\Runtime\Connection\ConnectionManagerSingle $connection_manager) {
            $configuration = [
                'dsn' => $container->getParam('propel/dsn'),
                'user' => $container->getParam('propel/db_user'),
                'password' => $container->getParam('propel/db_password'),
                'settings' => [
                    'charset' => 'utf8',
                ]
            ];

            $schema = $container->getParam('propel/db_schema');

            if ($schema !== 'public' && $schema !== null) {
                $configuration['settings']['queries'] = [
                    'schema' => "SET search_path TO " . $schema
                ];
            }

            $connection_manager->setConfiguration($configuration);
        }
    ],
];