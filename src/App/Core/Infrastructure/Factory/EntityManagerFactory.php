<?php

declare (strict_types = 1);

namespace App\Core\Infrastructure\Factory;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Proxy\ProxyFactory;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Mapping\Driver\XmlDriver;

final class EntityManagerFactory
{
    public static function createEntityManager(Connection $connection, array $schemaClassNames): EntityManager
    {
        $config = new Configuration();

        $config->setProxyDir(__DIR__);
        $config->setProxyNamespace('Doctrine\Tests\Proxies');
        $config->setAutoGenerateProxyClasses(ProxyFactory::AUTOGENERATE_NEVER);
        $config->setMetadataDriverImpl(
            new XmlDriver(
                [
                    __DIR__ . '/../Persistence/Doctrine/Metadata',
                    __DIR__ . '/../../../User/Infrastructure/Persistence/Doctrine/Metadata',
                ]
            )
        );

        $entityManager = EntityManager::create($connection, $config);

        (new SchemaTool($entityManager))
            ->createSchema(array_map([$entityManager, 'getClassMetadata'], $schemaClassNames));

        return $entityManager;
    }
}
