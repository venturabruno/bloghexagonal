<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Factory;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Container\ContainerInterface;
use Zend\Cache\Psr\CacheItemPool\CacheItemPoolDecorator;
use Zend\Cache\StorageFactory;

final class CacheItemPoolFactory
{
    public function __invoke(ContainerInterface $container): CacheItemPoolInterface
    {
        $storage = StorageFactory::factory([
            'adapter' => [
                'name' => 'redis',
                'options' => [
                    'server' => [
                        'host' => 'redis',
                        'port' => 6379,
                    ],
                    'password' => '123456789'
                ],
            ],
            'plugins' => [
                'serializer'
            ],
        ]);

        return new CacheItemPoolDecorator($storage);
    }
}
