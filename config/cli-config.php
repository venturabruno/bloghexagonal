<?php

$container = require 'config/container.php';
$config = $container->get('config');
$migrationConfig = $config['doctrine']['migrations'];
$em = $container->get(Doctrine\ORM\EntityManager::class);
$connection = $em->getConnection();

$configuration = new \Doctrine\DBAL\Migrations\Configuration\Configuration($connection);
$configuration->setName($migrationConfig['name']);
$configuration->setMigrationsNamespace($migrationConfig['migrations_namespace']);
$configuration->setMigrationsTableName($migrationConfig['table_name']);
$configuration->setMigrationsColumnName($migrationConfig['column_name']);
$configuration->setMigrationsDirectory($migrationConfig['migrations_directory']);

return new \Symfony\Component\Console\Helper\HelperSet([
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em),
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($connection),
    'configuration' => new \Doctrine\DBAL\Migrations\Tools\Console\Helper\ConfigurationHelper($connection, $configuration)
]);
