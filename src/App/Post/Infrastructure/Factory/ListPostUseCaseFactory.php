<?php

namespace App\Post\Infrastructure\Factory;

use App\Post\Application\UseCase\ListPost\ListPostUseCase;
use App\Post\Domain\PostRepository;
use Psr\Container\ContainerInterface;

class ListPostUseCaseFactory
{
    public function __invoke(ContainerInterface $container) : ListPostUseCase
    {
        return new ListPostUseCase(
            $container->get(PostRepository::class)
        );
    }
}
