<?php

namespace App\Post\Infrastructure\Factory;

use App\Post\Domain\PostRepository;
use App\Post\Application\UseCase\Post\PostUseCase;
use Psr\Container\ContainerInterface;

class PostUseCaseFactory
{
    public function __invoke(ContainerInterface $container) : PostUseCase
    {
        return new PostUseCase(
            $container->get(PostRepository::class)
        );
    }
}
