<?php

return [
    'propel' => [
        'database' => [
            'connections' => [
                'ncanode' => [
                    'adapter' => 'pgsql',
                    'dsn' => 'pgsql:host=db;port=5432;dbname=ncanode',
                    'user' => 'postgres',
                    'password' => 'postgres',
                    'settings' => [
                        'charset' => 'utf8',
                        'queries' => [
                            'utf8' => "SET NAMES 'UTF8'"
                        ]
                    ],
                    'attributes' => []
                ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'ncanode',
            'connections' => ['ncanode']
        ],
        'generator' => [
            'defaultConnection' => 'ncanode',
            'connections' => ['ncanode']
        ]
    ]
];
