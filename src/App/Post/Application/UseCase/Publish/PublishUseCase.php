<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\Publish;

use App\Post\Domain\PostRepository;

class PublishUseCase
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke(PublishRequest $postRequest): PublishResponse
    {
        $post = $this->postRepository->find($postRequest->id());

        if (is_null($post)) {
            throw new UserAlreadyExistsException();
        }

        $post->publish();

        $this->postRepository->save($post);

        return new PublishResponse($post);
    }
}
