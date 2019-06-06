<?php

namespace App\Post\Infrastructure\Handler;

use App\Post\Application\UseCase\Post\ListPostUseCase;
use Psr\Container\ContainerInterface;

class ListPostHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ListPostHandler
    {
        return new ListPostHandler(
            $container->get(ListPostUseCase::class)
        );
    }
}
