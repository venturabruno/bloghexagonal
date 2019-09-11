<?php

declare(strict_types=1);

namespace Test\Unit\AppTest\Core\Domain;

use App\Core\Domain\UuId;
use PHPUnit\Framework\TestCase;
use App\Core\Domain\Entity;

final class EntityTest extends TestCase
{
    public function testCompareSameObjects()
    {
        $entity = new class extends Entity {
            public function __construct()
            {
                $this->setId(UuId::new());
            }
        };

        $this->assertTrue($entity->equals($entity));
    }

    public function testCompareDifferencesObjects()
    {
        $entity = new class extends Entity {
            public function __construct()
            {
                $this->setId(UuId::new());
            }
        };

        $entity2 = new class extends Entity {
            public function __construct()
            {
                $this->setId(UuId::new());
            }
        };

        $this->assertFalse($entity->equals($entity2));
    }

    public function testCompareObjectsWithIdsEquals()
    {
        $uuid = UuId::new();

        $entity = new class($uuid) extends Entity {
            public function __construct($uuid)
            {
                $this->setId($uuid);
            }
        };

        $entity2 = new class($uuid) extends Entity {
            public function __construct($uuid)
            {
                $this->setId($uuid);
            }
        };

        $this->assertTrue($entity->equals($entity2));
    }
}
