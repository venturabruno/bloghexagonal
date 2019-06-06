<?php

declare(strict_types=1);

namespace App\Post\Domain;

final class Title
{
    const MIN_LENGTH = 3;
    const MAX_LENGTH = 250;

    private $title;

    private function __construct(
        string $title
    ) {
        $this->setTitle($title);
    }

    public static function fromNativeData(
        string $title
    ):self {
        return new self(
            $title
        );
    }

    public static function new(string $title): self
    {
        return new self($title);
    }

    public function title(): string
    {
        return $this->title;
    }

    private function setTitle(string $title)
    {
        if (empty($title)) {
            throw new \InvalidArgumentException('Title is empty');
        }

        if (strlen($title) < self::MIN_LENGTH) {
            throw new \InvalidArgumentException('Title is too short');
        }

        if (strlen($title) > self::MAX_LENGTH) {
            throw new \InvalidArgumentException('Title is too long');
        }

        $this->title = $title;
    }

    public function __toString() : string
    {
        return (string) $this->title;
    }
}
