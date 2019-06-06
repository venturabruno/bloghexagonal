<?php

declare(strict_types=1);

namespace Test\Unit\AppTest\Core\Infrastructure\Factory;

use PHPUnit\Framework\TestCase;
use App\Core\Infrastructure\Factory\EntityFactory;
use Doctrine\ORM\EntityManager;

class EntityFactoryTest extends TestCase
{
    public function testInvoke()
    {
        $container = require 'config/container.php';
        $entityFactory = new EntityFactory();
        $entityFactory($container, EntityManager::class);

        $this->assertInstanceOf(EntityFactory::class, $entityFactory);
    }
}
