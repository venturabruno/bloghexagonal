<?php

return [
    'doctrine' => [
        'orm' => [
            'auto_generate_proxy_classes' => false,
            'proxy_dir' => 'data/cache/EntityProxy',
            'proxy_namespace' => 'EntityProxy',
            'underscore_naming_strategy' => true,
        ],
        'connection' => [
            'orm_default' => [
                'driver' => 'pdo_mysql',
                'host' => getenv('MYSQL_HOST'),
                'port' => 3306,
                'dbname' => getenv('MYSQL_DATABASE'),
                'user' => getenv('MYSQL_USER'),
                'password' => getenv('MYSQL_PASSWORD'),
                'charset ' => ' UTF8',
            ],
            'orm_test' => [
                'driver' => 'pdo_sqlite',
                'path' => __DIR__ . '../../data/db/data.db',
                'user' => 'test',
                'charset' => 'UTF8',
            ],
        ],
        'migrations' => [
            'name' => 'ONCACMS Migrations',
            'migrations_namespace' => 'App\Core\Migrations',
            'table_name' => 'doctrine_migration_versions',
            'column_name' => 'version',
            'migrations_directory' => 'database/doctrine/migrations',
        ]
    ]
];
