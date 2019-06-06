<?php

declare(strict_types=1);

namespace Test\Unit\AppTest\Core\Domain;

use PHPUnit\Framework\TestCase;
use App\Core\Domain\UuId;

final class UuIdTest extends TestCase
{
    public function testFromObjectToStringAndBack()
    {
        $id = UuId::new();
        self::assertEquals($id, UuId::fromString((string) $id));
    }
}
