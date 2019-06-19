<?php

declare(strict_types=1);

namespace App\Post\Domain;

final class Subtitle
{
    const MIN_LENGTH = 3;
    const MAX_LENGTH = 255;

    private $subtitle;

    private function __construct(
        string $subtitle
    ) {
        $this->setSubtitle($subtitle);
    }

    public static function fromNativeData(
        string $subtitle
    ):self {
        return new self(
            $subtitle
        );
    }

    public static function new(string $subtitle): self
    {
        return new self($subtitle);
    }

    public function subtitle(): string
    {
        return $this->subtitle;
    }

    private function setSubtitle(string $subtitle)
    {
        if (empty($subtitle)) {
            throw new \InvalidArgumentException('Subtitle is empty');
        }

        if (strlen($subtitle) < self::MIN_LENGTH) {
            throw new \InvalidArgumentException('Subtitle is too short');
        }

        if (strlen($subtitle) > self::MAX_LENGTH) {
            throw new \InvalidArgumentException('Subtitle is too long');
        }

        $this->subtitle = $subtitle;
    }

    public function __toString() : string
    {
        return (string) $this->subtitle;
    }
}
