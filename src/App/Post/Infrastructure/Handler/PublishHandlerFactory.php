<?php

namespace App\Post\Infrastructure\Handler;

use App\Post\Application\UseCase\Publish\PublishUseCase;
use Psr\Container\ContainerInterface;

class PublishHandlerFactory
{
    public function __invoke(ContainerInterface $container) : PublishHandler
    {
        return new PublishHandler(
            $container->get(PublishUseCase::class)
        );
    }
}
