<?php

return [
    'propel' => [
        'bin'           => 'vendor/bin/propel',
        'project'       => 'ncanode',
        'database'      => 'pgsql',
        'dsn'           => 'pgsql:host=db;port=5432;dbname=ncanode',
        'db_user'       => 'postgres',
        'db_password'   => 'postgres',
        'platform'      => 'pgsql',
        'config_dir'    => './',
        'schema_dir'    => 'src/Resource/propel/schema',
        'model_dir'     => 'src/Model',
        'migration_dir' => 'src/Resource/propel/migration',
        'migration_table' => 'ncanode_propel_migration',
    ],
    'database' => [
        'db' => 'ncanode',
        'host' => 'db',
        'port' => '5432',
        'username' => 'postgres',
        'password' => 'postgres',
    ],
    'ncanode' => [
        'timezone' => 'Utc',
    ],
];