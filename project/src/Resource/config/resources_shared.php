<?php

return [
    'propel' => [
        'bin'           => 'vendor/bin/propel',
        'project'       => 'ncanode',
        'database'      => 'pgsql',
        'dsn'           => 'pgsql:host=PG_HOST;port=PG_PORT;dbname=PG_DATABASE',
        'db_user'       => 'PG_USER',
        'db_password'   => 'PG_PASSWORD',
        'platform'      => 'pgsql',
        'config_dir'    => 'src/Resource/propel/connection',
        'schema_dir'    => 'src/Resource/propel/schema',
        'model_dir'     => 'src/Model',
        'migration_dir' => 'src/Resource/propel/migration',
        'migration_table' => 'ncanode_propel_migration',
    ],
    
    'ncanode' => [
        'remote_url' => 'NCANODE_REMOTE_URL',
        'key' => 'NCANODE_KEY',
        'pwd' => 'NCANODE_PWD',
        'dummy' => 'NCANODE_DUMMY',
        'timezone' => 'NCANODE_TIMEZONE',
    ],

    '_translator' => [
        [__DIR__ . '/../translation/ru/common.php', 'ru'],
        [__DIR__ . '/../translation/ru/errors.php', 'ru'],
        [__DIR__ . '/../translation/en/common.php', 'en'],
        [__DIR__ . '/../translation/en/errors.php', 'en'],
        [__DIR__ . '/../translation/kz/common.php', 'kz'],
        [__DIR__ . '/../translation/kz/errors.php', 'kz'],
    ],
];
