<?php

declare(strict_types=1);

namespace App\Post\Infrastructure\Persistence\Doctrine;

use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;

final class DoctrinePostRepositoryFactory
{
    public function __invoke(ContainerInterface $container): DoctrinePostRepository
    {
        return new DoctrinePostRepository(
            $container->get(EntityManager::class)
        );
    }
}
