<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\Post;

use App\Post\Domain\Title;

class PostRequest
{
    private $title;
    private $content;

    public function __construct(string $title, string $content)
    {
        $this->title = Title::new($title);
        $this->content = $content;
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function content(): string
    {
        return $this->content;
    }
}
