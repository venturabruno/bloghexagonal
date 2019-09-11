<?php

declare(strict_types=1);

namespace App\Post\Domain;

use App\Core\Domain\Entity;
use App\Core\Domain\UuId;

final class Post extends Entity implements \JsonSerializable
{
    private $id;
    private $title;
    private $subtitle;
    private $content;
    private $status;
    private $createdAt;
    private $publishedAt;

    private function __construct(
        UuId $id,
        Title $title,
        Subtitle $subtitle,
        Content $content,
        Status $status,
        \DateTime $createdAt,
        ?\DateTime $publishedAt = null
    ) {
        $this->setId($id);
        $this->setTitle($title);
        $this->setSubtitle($subtitle);
        $this->setContent($content);
        $this->setStatus($status);
        $this->setCreatedAt($createdAt);
        $this->setPublishedAt($publishedAt);
    }

    public static function fromNativeData(
        string $id,
        Title $title,
        Subtitle $subtitle,
        Content $content,
        Status $status,
        \DateTime $createdAt,
        ?\DateTime $publishedAt = null
    ):self {
        return new self(
            UuId::fromString($id),
            $title,
            $subtitle,
            $content,
            $status,
            $createdAt,
            $publishedAt
        );
    }

    public static function new(Title $title, Subtitle $subtitle, Content $content): self
    {
        $id = UuId::new();
        $status = Status::draft();
        $createdAt = new \DateTime();

        return new self($id, $title, $subtitle, $content, $status, $createdAt);
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

    public function status(): Status
    {
        return $this->status;
    }

    public function createdAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function publishedAt(): ?\DateTime
    {
        return $this->publishedAt;
    }

    private function setTitle(Title $title)
    {
        $this->title = $title;
    }

    private function setSubtitle(Subtitle $subtitle)
    {
        $this->subtitle = $subtitle;
    }

    private function setContent(Content $content)
    {
        $this->content = $content;
    }

    private function setStatus(Status $status)
    {
        $this->status = $status;
    }

    private function setCreatedAt(\DateTime $createdAt)
    {
        if (empty($createdAt)) {
            throw new \InvalidArgumentException('CreatedAt is empty');
        }

        $this->createdAt = $createdAt;
    }

    private function setPublishedAt(?\DateTime $publishedAt)
    {
        $this->publishedAt = $publishedAt;
    }

    public function publish()
    {
        $this->setStatus(Status::published());
        $this->setPublishedAt(new \DateTime());
    }

    public function unpublish()
    {
        $this->setStatus(Status::draft());
        $this->publishedAt = null ;
    }

    public function isPublished()
    {
        return $this->status->equalsTo(Status::published());
    }

    public function jsonSerialize()
    {
        return [
            'id' => (string) $this->id,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'content' => $this->content,
            'status' => $this->status,
            'createdAt' => $this->createdAt,
            'publishedAt' => $this->publishedAt
        ];
    }
}
