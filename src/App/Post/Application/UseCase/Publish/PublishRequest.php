<?php

declare(strict_types=1);

namespace App\Post\Application\UseCase\Publish;

use App\Core\Domain\UuId;

class PublishRequest
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = UuId::fromString($id);
    }

    public function id(): UuId
    {
        return $this->id;
    }
}
