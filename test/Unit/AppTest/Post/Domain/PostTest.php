<?php

declare(strict_types=1);

namespace Test\Unit\AppTest\Post\Domain;

use App\Post\Domain\Subtitle;
use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;
use App\Core\Domain\UuId;
use App\Post\Domain\Post;
use App\Post\Domain\Status;
use App\Post\Domain\Title;

class PostTest extends TestCase
{
    private $data;

    public function setUp()
    {
        $faker = Faker::create('pt_BR');

        $this->data['id'] = UuId::new();
        $this->data['title'] = Title::new($faker->title);
        $this->data['subtitle'] = Subtitle::new($faker->title);
        $this->data['content'] = $faker->realText();
        $this->data['status'] = Status::draft();
        $this->data['createdAt'] = new \DateTime;
        $this->data['publishedAt'] =  new \DateTime;
    }

    public function testFromNativeData()
    {
        $post = Post::fromNativeData(
            (string) $this->data['id'],
            $this->data['title'],
            $this->data['subtitle'],
            $this->data['content'],
            $this->data['status'],
            $this->data['createdAt'],
            $this->data['publishedAt']
        );

        $this->assertInstanceOf(Post::class, $post);
        $this->assertEquals($post->id(), $this->data['id']);
        $this->assertEquals($post->title(), $this->data['title']);
        $this->assertEquals($post->subtitle(), $this->data['subtitle']);
        $this->assertEquals($post->content(), $this->data['content']);
        $this->assertEquals($post->status(), $this->data['status']);
        $this->assertEquals($post->createdAt(), $this->data['createdAt']);
        $this->assertEquals($post->publishedAt(), $this->data['publishedAt']);
    }

    public function testNew()
    {
        $post = Post::new($this->data['title'], $this->data['subtitle'], $this->data['content']);

        $this->assertInstanceOf(Post::class, $post);
        $this->assertInstanceOf(UuId::class, $post->id());
        $this->assertEquals($post->title(), $this->data['title']);
        $this->assertEquals($post->subtitle(), $this->data['subtitle']);
        $this->assertEquals($post->content(), $this->data['content']);
    }

    public function testJsonSerialize()
    {
        $post = Post::fromNativeData(
            (string) $this->data['id'],
            $this->data['title'],
            $this->data['subtitle'],
            $this->data['content'],
            $this->data['status'],
            $this->data['createdAt'],
            $this->data['publishedAt']
        );

        $expected =[
            'id' => (string) $this->data['id'],
            'title' => $this->data['title'],
            'subtitle' => $this->data['subtitle'],
            'content' => $this->data['content'],
            'status' => $this->data['status'],
            'createdAt' => $this->data['createdAt'],
            'publishedAt' => $this->data['publishedAt']
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), json_encode($post));
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Invalid UUID string
     */
    public function testIdInvalid()
    {
        $post = Post::fromNativeData(
            'a',
            $this->data['title'],
            $this->data['subtitle'],
            $this->data['content'],
            $this->data['status'],
            $this->data['createdAt'],
            $this->data['publishedAt']
        );
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Content is empty
     */
    public function testContentIsEmpty()
    {
        Post::new($this->data['title'], $this->data['subtitle'], '');
    }

    public function testPublish()
    {
        $post = Post::new($this->data['title'], $this->data['subtitle'], $this->data['content']);

        $post->publish();

        $this->assertTrue($post->status()->equalsTo(Status::published()));
        $this->assertInstanceOf(\DateTime::class, $post->publishedAt());
    }
}
