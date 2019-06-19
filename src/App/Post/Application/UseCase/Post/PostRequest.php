<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\Post;

use App\Post\Domain\Content;
use App\Post\Domain\Subtitle;
use App\Post\Domain\Title;

class PostRequest
{
    private $title;
    private $subtitle;
    private $content;

    public function __construct(string $title, string $subtitle, string $content)
    {
        $this->title = Title::new($title);
        $this->subtitle = Subtitle::new($subtitle);
        $this->content = Content::new($content);
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function subtitle(): Subtitle
    {
        return $this->subtitle;
    }

    public function content(): Content
    {
        return $this->content;
    }
}
