<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\ListPost;

class ListPostResponse implements \JsonSerializable
{
    private $posts;

    public function __construct(array $posts)
    {
        $this->posts = $posts;
    }

    public function posts(): array
    {
        return $this->posts;
    }

    public function jsonSerialize(): array
    {
        $posts = [];

        foreach ($this->posts as $post) {
            $posts[] = [
                'id' => (string) $post->id(),
                'title' => (string) $post->title(),
                'subtitle' => (string) $post->subtitle(),
                'content' => (string) $post->content(),
                'published' => $post->isPublished(),
                'publishedAt' => $post->publishedAt()
            ];
        }

        return $posts;
    }
}
