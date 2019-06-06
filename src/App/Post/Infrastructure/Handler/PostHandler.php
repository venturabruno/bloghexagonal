<?php

declare(strict_types=1);

namespace App\Post\Infrastructure\Handler;

use App\Post\Application\UseCase\Post\PostRequest;
use App\Post\Application\UseCase\Post\PostUseCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class PostHandler implements RequestHandlerInterface
{
    private $postUseCase;

    public function __construct(PostUseCase $postUseCase)
    {
        $this->postUseCase = $postUseCase;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $params = $request->getParsedBody();

        try {
            $postRequest = new PostRequest(
                $params['title'] ?? '',
                $params['content'] ?? ''
            );
            $postUseCase = $this->postUseCase;
            $postResponse = $postUseCase($postRequest);
        } catch (UserAlreadyExistsException $exception) {
            return new JsonResponse([$exception->getMessage()], 422);
        } catch (\LogicException $exception) {
            return new JsonResponse([$exception->getMessage()], 422);
        }
        return new JsonResponse($postResponse);
    }
}
