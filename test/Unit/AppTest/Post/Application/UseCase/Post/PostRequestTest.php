<?php

declare(strict_types=1);

namespace Test\Unit\AppTest\Post\Application\UseCase\Post;

use App\Post\Application\UseCase\Post\PostRequest;
use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;

class PostRequestTest extends TestCase
{
    private $postRequest;
    private $title;
    private $subtitle;
    private $content;

    public function setUp()
    {
        $faker = Faker::create('pt_BR');

        $this->title = $faker->title;
        $this->subtitle = $faker->title;
        $this->content = $faker->realText();

        $this->postRequest = new PostRequest($this->title, $this->subtitle, $this->content);
    }

    public function testTitle()
    {
        $this->assertEquals($this->postRequest->title(), $this->title);
    }

    public function testSubtitle()
    {
        $this->assertEquals($this->postRequest->subtitle(), $this->subtitle);
    }

    public function testContent()
    {
        $this->assertEquals($this->postRequest->content(), $this->content);
    }

    public function testJsonSe()
    {
        $this->assertEquals($this->postRequest->content(), $this->content);
    }
}
