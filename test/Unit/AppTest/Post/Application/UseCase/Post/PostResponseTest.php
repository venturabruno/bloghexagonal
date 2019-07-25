<?php

declare(strict_types=1);

namespace Test\Unit\AppTest\Post\Application\UseCase\Post;

use App\Post\Application\UseCase\Post\PostResponse;
use App\Post\Domain\Content;
use App\Post\Domain\Post;
use App\Post\Domain\Status;
use App\Post\Domain\Subtitle;
use App\Post\Domain\Title;
use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;

class PostResponseTest extends TestCase
{
    private $postResponse;
    private $title;
    private $subtitle;
    private $content;

    public function setUp()
    {
        $faker = Faker::create('pt_BR');

        $this->title = $faker->title;
        $this->subtitle = $faker->title;
        $this->content = $faker->realText();

        $post = Post::fromNativeData(
            $faker->uuid,
            Title::new($this->title),
            Subtitle::new($this->subtitle),
            Content::new($this->content),
            Status::draft(),
            new \DateTime,
            new \DateTime
        );

        $this->postResponse = new PostResponse($post);
    }

    public function testTitle()
    {
        $this->assertEquals($this->postResponse->title(), $this->title);
    }

    public function testSubtitle()
    {
        $this->assertEquals($this->postResponse->subtitle(), $this->subtitle);
    }

    public function testContent()
    {
        $this->assertEquals($this->postResponse->content(), $this->content);
    }

    public function testJsonSerialize()
    {
        $json = json_encode([
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'content' => $this->content
        ]);

        $this->assertEquals($json, json_encode($this->postResponse));
    }
}
