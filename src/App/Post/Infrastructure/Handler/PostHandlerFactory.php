<?php

namespace App\Post\Infrastructure\Handler;

use App\Post\Application\UseCase\Post\PostUseCase;
use Psr\Container\ContainerInterface;

class PostHandlerFactory
{
    public function __invoke(ContainerInterface $container) : PostHandler
    {
        return new PostHandler(
            $container->get(PostUseCase::class)
        );
    }
}
