<?php

declare(strict_types=1);

namespace App\Post\Infrastructure\Handler;

use App\Post\Application\UseCase\ListPost\ListPostUseCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class ListPostHandler implements RequestHandlerInterface
{
    private $listPostUseCase;

    public function __construct(ListPostUseCase $listPostUseCase)
    {
        $this->listPostUseCase = $listPostUseCase;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $listPostUseCase = null;

        try {
            $listPostUseCase = ($this->listPostUseCase) ();
        } catch (\LogicException $exception) {
            return new JsonResponse([$exception->getMessage()], 422);
        }
        return new JsonResponse($listPostUseCase);
    }
}
