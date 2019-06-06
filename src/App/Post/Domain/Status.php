<?php

declare(strict_types=1);

namespace App\Post\Domain;

final class Status
{
    const PUBLISHED = 10;
    const DRAFT = 20;

    private $status;

    private function __construct(
        int $status
    ) {
        $this->setStatus($status);
    }

    public static function fromNativeData(
        int $status
    ): self {
        return new self(
            $status
        );
    }

    private function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function status(): int
    {
        return $this->status;
    }

    public static function published(): self
    {
        return new self(self::PUBLISHED);
    }

    public static function draft(): self
    {
        return new self(self::DRAFT);
    }

    public function equalsTo(self $status)
    {
        return $this->status === $status->status;
    }

    public function __toString(): string
    {
        return (string) $this->status;
    }
}
