<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ListPost;

use App\Post\Domain\PostRepository;

class ListPostUseCase
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke(): ListPostResponse
    {
        return new ListPostResponse($this->postRepository->all());
    }
}
