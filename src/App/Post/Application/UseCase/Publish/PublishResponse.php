<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\Publish;

use App\Post\Domain\Post;

class PublishResponse implements \JsonSerializable
{
    private $title;
    private $subtitle;
    private $content;

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
        return $this->content->content();
    }

    public function jsonSerialize(): array
    {
        return [
            'title' => (string) $this->title,
            'subtitle' => (string) $this->subtitle,
            'content' => (string) $this->content
        ];
    }
}
