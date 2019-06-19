<?php

declare(strict_types=1);

namespace Test\Unit\AppTest\Post\Domain;

use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;
use App\Post\Domain\Content;

class ContentTest extends TestCase
{
    private $content;

    public function setUp()
    {
        $faker = Faker::create('pt_BR');
        $this->content = $faker->realText();
    }

    public function testFromNativeData()
    {
        $content = Content::fromNativeData($this->content);

        $this->assertInstanceOf(Content::class, $content);
        $this->assertEquals($content->content(), $this->content);
    }

    public function testNew()
    {
        $content = Content::new($this->content);

        $this->assertInstanceOf(Content::class, $content);
        $this->assertEquals($content->content(), $this->content);
    }

    public function testContent()
    {
        $content = Content::new($this->content);

        $this->assertEquals($content->content(), $this->content);
    }

    public function testString()
    {
        $content = Content::new($this->content);

        $this->assertEquals($this->content, (string) $content);
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Content is empty
     */
    public function testInvalid()
    {
        Content::new('');
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Content is too long
     */
    public function testTooLong()
    {
        $faker = Faker::create('pt_BR');
        Content::new($faker->text(66000));
    }
}
