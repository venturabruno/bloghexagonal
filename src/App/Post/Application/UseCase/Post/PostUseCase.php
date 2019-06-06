<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\Post;

use App\Post\Domain\Post;
use App\Post\Domain\PostRepository;

class PostUseCase
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke(PostRequest $postRequest): PostResponse
    {
        $post = Post::new(
            $postRequest->title(),
            $postRequest->content()
        );

        $this->postRepository->add($post);

        return new PostResponse($post);
    }
}
