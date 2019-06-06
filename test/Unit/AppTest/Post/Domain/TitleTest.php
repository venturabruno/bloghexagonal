<?php

declare(strict_types=1);

namespace Test\Unit\AppTest\Post\Domain;

use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;
use App\Post\Domain\Title;

class TitleTest extends TestCase
{
    private $title;

    public function setUp()
    {
        $faker = Faker::create('pt_BR');
        $this->title = $faker->text(100);
    }

    public function testFromNativeData()
    {
        $title = Title::fromNativeData($this->title);

        $this->assertInstanceOf(Title::class, $title);
        $this->assertEquals($title->title(), $this->title);
    }

    public function testNew()
    {
        $title = Title::new($this->title);

        $this->assertInstanceOf(Title::class, $title);
        $this->assertEquals($title->title(), $this->title);
    }

    public function testTitle()
    {
        $title = Title::new($this->title);

        $this->assertEquals($title->title(), $this->title);
    }

    public function testString()
    {
        $title = Title::new($this->title);

        $this->assertEquals($this->title, (string) $title);
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Title is empty
     */
    public function testInvalid()
    {
        Title::new('');
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Title is too short
     */
    public function testTooShort()
    {
        Title::new('ab');
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Title is too long
     */
    public function testTooLong()
    {
        $faker = Faker::create('pt_BR');
        Title::new($faker->text(600));
    }
}
