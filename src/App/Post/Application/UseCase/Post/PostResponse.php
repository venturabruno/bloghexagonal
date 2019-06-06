<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\Post;

use App\Post\Domain\Post;

class PostResponse implements \JsonSerializable
{
    private $title;
    private $content;

    public function __construct(Post $post)
    {
        $this->title = $post->title();
        $this->content = $post->content();
    }

    public function title(): string
    {
        return $this->title->title();
    }

    public function content(): string
    {
        return $this->content;
    }

    public function jsonSerialize(): array
    {
        return [
            'title' => (string) $this->title,
            'content' => $this->content
        ];
    }
}
