<?php

declare(strict_types=1);

namespace App\Core\Domain;

use Ramsey\Uuid\Uuid as Uuid4;
use Ramsey\Uuid\UuidInterface;

final class UuId
{
    private $id;

    private function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

    public static function new() : self
    {
        return new self(Uuid4::uuid4());
    }

    public static function fromString(string $id) : self
    {
        return new self(Uuid4::fromString($id));
    }

    public function __toString() : string
    {
        return $this->id->toString();
    }
}
