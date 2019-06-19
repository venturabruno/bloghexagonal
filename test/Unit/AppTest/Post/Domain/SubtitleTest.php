<?php

declare(strict_types=1);

namespace Test\Unit\AppTest\Post\Domain;

use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;
use App\Post\Domain\Subtitle;

class SubtitleTest extends TestCase
{
    private $subtitle;

    public function setUp()
    {
        $faker = Faker::create('pt_BR');
        $this->subtitle = $faker->text(100);
    }

    public function testFromNativeData()
    {
        $subtitle = Subtitle::fromNativeData($this->subtitle);

        $this->assertInstanceOf(Subtitle::class, $subtitle);
        $this->assertEquals($subtitle->subtitle(), $this->subtitle);
    }

    public function testNew()
    {
        $subtitle = Subtitle::new($this->subtitle);

        $this->assertInstanceOf(Subtitle::class, $subtitle);
        $this->assertEquals($subtitle->subtitle(), $this->subtitle);
    }

    public function testSubtitle()
    {
        $subtitle = Subtitle::new($this->subtitle);

        $this->assertEquals($subtitle->subtitle(), $this->subtitle);
    }

    public function testString()
    {
        $subtitle = Subtitle::new($this->subtitle);

        $this->assertEquals($this->subtitle, (string) $subtitle);
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Subtitle is empty
     */
    public function testInvalid()
    {
        Subtitle::new('');
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Subtitle is too short
     */
    public function testTooShort()
    {
        Subtitle::new('ab');
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Subtitle is too long
     */
    public function testTooLong()
    {
        $faker = Faker::create('pt_BR');
        Subtitle::new($faker->text(600));
    }
}
