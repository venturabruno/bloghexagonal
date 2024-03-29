<?php

declare(strict_types=1);

namespace App\Post\Infrastructure\Handler;

use App\Post\Application\UseCase\Publish\PublishRequest;
use App\Post\Application\UseCase\Publish\PublishUseCase;
use App\Post\Domain\PostDoesNotExistException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class PublishHandler implements RequestHandlerInterface
{
    private $publishUseCase;

    public function __construct(PublishUseCase $publishUseCase)
    {
        $this->publishUseCase = $publishUseCase;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        try {
            $publishRequest = new PublishRequest(
                $request->getAttribute('id')
            );
            $publishUseCase = $this->publishUseCase;
            $publishResponse = $publishUseCase($publishRequest);
        } catch (PostDoesNotExistException $exception) {
            return new JsonResponse([$exception->getMessage()], 422);
        } catch (\LogicException $exception) {
            return new JsonResponse([$exception->getMessage()], 422);
        }
        return new JsonResponse($publishResponse);
    }
}
