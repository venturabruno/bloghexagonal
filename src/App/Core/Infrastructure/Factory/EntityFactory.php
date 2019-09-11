<?php

declare (strict_types=1);

namespace App\Core\Infrastructure\Factory;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Interop\Container\ContainerInterface;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\ApcuCache;
use Doctrine\ORM\Mapping\Driver\XmlDriver;
use Zend\ServiceManager\Factory\FactoryInterface;
use Doctrine\DBAL\Types\Type;

class EntityFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $appConfig = $container->get('config');
        $doctrineConfig = $appConfig['doctrine'];
        $development = $appConfig['debug'] ?? false;

        if (!isset($doctrineConfig['connection']['orm_default'])) {
            throw new \UnexpectedValueException("Missing doctrine connection config for orm_default driver");
        }

        $cache = $this->defineCache($development);

        $config = new Configuration();
        $config->setAutoGenerateProxyClasses($development);
        $config->setProxyDir($doctrineConfig['orm']['proxy_dir']);
        $config->setProxyNamespace($doctrineConfig['orm']['proxy_namespace']);
        $config->setMetadataDriverImpl(
            new XmlDriver(
                $appConfig['doctrine']['metadata']
            )
        );
        $config->setNamingStrategy(new UnderscoreNamingStrategy());
        $config->setQueryCacheImpl($cache);
        $config->setMetadataCacheImpl($cache);

        $this->addTypes($doctrineConfig);

        return EntityManager::create($doctrineConfig['connection']['orm_default'], $config);
    }

    private function addTypes($doctrineConfig)
    {
        foreach ($doctrineConfig['type'] as $type => $path) {
            if (!Type::hasType($type)) {
                Type::addType($type, $path);
            }
        }
    }

    private function defineCache($development)
    {
        if ($development) {
            return new ArrayCache();
        }

        return new ApcuCache();
    }
}
