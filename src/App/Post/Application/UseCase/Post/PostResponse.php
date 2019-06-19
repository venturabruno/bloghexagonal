<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\Post;

use App\Post\Domain\Post;

class PostResponse implements \JsonSerializable
{
    private $title;
    private $content;
    private $subtitle;

    public function __construct(Post $post)
    {
        $this->title = $post->title();
        $this->subtitle = $post->subtitle();
        $this->content = $post->content();
    }

    public function title(): string
    {
        return $this->title->title();
    }

    public function subtitle(): string
    {
        return $this->subtitle->subtitle();
    }

    public function content(): string
    {
        return $this->content;
    }

    public function jsonSerialize(): array
    {
        return [
            'title' => (string) $this->title,
            'subtitle' => (string) $this->subtitle,
            'content' => $this->content
        ];
    }
}
