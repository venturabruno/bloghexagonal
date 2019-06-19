<?php

declare(strict_types=1);

namespace App\Post\Domain;

final class Content
{
    const MAX_LENGTH = 65535;

    private $content;

    private function __construct(
        string $content
    ) {
        $this->setTitle($content);
    }

    public static function fromNativeData(
        string $content
    ):self {
        return new self(
            $content
        );
    }

    public static function new(string $content): self
    {
        return new self($content);
    }

    public function content(): string
    {
        return $this->content;
    }

    private function setTitle(string $content)
    {
        if (empty($content)) {
            throw new \InvalidArgumentException('Content is empty');
        }

        if (strlen($content) > self::MAX_LENGTH) {
            throw new \InvalidArgumentException('Content is too long');
        }

        $this->content = $content;
    }

    public function __toString() : string
    {
        return (string) $this->content;
    }
}
