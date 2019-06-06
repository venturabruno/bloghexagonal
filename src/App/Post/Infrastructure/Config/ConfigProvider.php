<?php

declare(strict_types=1);

namespace App\Post\Infrastructure\Config;

use App\Post\Application\UseCase\Post\ListPostUseCase;
use App\Post\Domain\PostRepository;
use App\Post\Application\UseCase\Post\PostUseCase;
use App\Post\Application\UseCase\Publish\PublishUseCase;
use App\Post\Infrastructure\Factory\ListPostUseCaseFactory;
use App\Post\Infrastructure\Factory\PostUseCaseFactory;
use App\Post\Infrastructure\Factory\PublishUseCaseFactory;
use App\Post\Infrastructure\Handler\ListPostHandler;
use App\Post\Infrastructure\Handler\ListPostHandlerFactory;
use App\Post\Infrastructure\Handler\PostHandler;
use App\Post\Infrastructure\Handler\PostHandlerFactory;
use App\Post\Infrastructure\Handler\PublishHandler;
use App\Post\Infrastructure\Handler\PublishHandlerFactory;
use App\Post\Infrastructure\Persistence\Doctrine\DoctrinePostRepositoryFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'doctrine' => [
                'metadata' => [
                    __DIR__ . '/../Persistence/Doctrine/Metadata',
                ],
            ]
        ];
    }

    public function getDependencies(): array
    {
        return [
            'invokables' => [
            ],
            'factories' => [
                PostHandler::class => PostHandlerFactory::class,
                PostUseCase::class => PostUseCaseFactory::class,
                PublishHandler::class => PublishHandlerFactory::class,
                PublishUseCase::class => PublishUseCaseFactory::class,
                PostRepository::class => DoctrinePostRepositoryFactory::class,
                ListPostUseCase::class => ListPostUseCaseFactory::class,
                ListPostHandler::class => ListPostHandlerFactory::class
            ],
        ];
    }
}
