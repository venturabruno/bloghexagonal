<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\Publish;

use App\Core\Domain\UuId;
use App\Post\Domain\Post;
use App\Post\Domain\Status;

class PublishResponse implements \JsonSerializable
{
    private $id;
    private $status;

    public function __construct(Post $post)
    {
        $this->id = $post->id();
        $this->status = $post->status();
    }

    public function id(): UuId
    {
        return $this->id;
    }

    public function status(): Status
    {
        return $this->status;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => (string) $this->id(),
            'status' => (string) $this->status(),
        ];
    }
}
