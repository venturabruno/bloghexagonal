<?php

namespace App\Post\Infrastructure\Factory;

use App\Post\Domain\PostRepository;
use App\Post\Application\UseCase\Publish\PublishUseCase;
use Psr\Container\ContainerInterface;

class PublishUseCaseFactory
{
    public function __invoke(ContainerInterface $container) : PublishUseCase
    {
        return new PublishUseCase(
            $container->get(PostRepository::class)
        );
    }
}
