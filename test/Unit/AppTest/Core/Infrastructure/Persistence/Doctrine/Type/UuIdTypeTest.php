<?php

declare(strict_types=1);

namespace Test\Unit\AppTest\Core\Infrastructure\Persistence\Doctrine\Type;

use PHPUnit\Framework\TestCase;
use App\Core\Infrastructure\Persistence\Doctrine\Type\UuIdType;
use Doctrine\DBAL\Platforms\MySqlPlatform;
use Faker\Factory as Faker;
use App\Core\Domain\UuId;
use Doctrine\DBAL\Types\Type;

class UuIdTypeTest extends TestCase
{
    private $type;
    private $platform;

    protected function setUp()
    {
        if (! Type::hasType('uuid_type')) {
            Type::addType('uuid_type', UuIdType::class);
        }
        $this->type = Type::getType('uuid_type');

        $this->platform = new MySqlPlatform();
    }

    public function testGetSQLDeclaration()
    {
        $declaration = $this->type->getSQLDeclaration([], $this->platform);

        $this->assertEquals('VARCHAR(36)', $declaration);
    }

    public function testConvertToPHPValue()
    {
        $faker = Faker::create('pt_BR');
        $uuId = $this->type->convertToPHPValue($faker->uuid, $this->platform);

        $this->assertInstanceOf(UuId::class, $uuId);
    }

    public function testConvertToDatabaseValue()
    {
        $faker = Faker::create('pt_BR');
        $uuid = $faker->uuid;
        $string = $this->type->convertToDatabaseValue($uuid, $this->platform);

        $this->assertEquals($uuid, $string);
    }

    public function testGetName()
    {
        $this->assertEquals('uuid_type', $this->type->getName());
    }
}
