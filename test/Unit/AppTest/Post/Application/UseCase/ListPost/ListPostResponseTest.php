<?php

declare(strict_types=1);

namespace Test\Unit\AppTest\Post\Application\UseCase\ListPost;

use App\Post\Domain\Content;
use App\Post\Domain\Post;
use App\Post\Domain\Status;
use App\Post\Domain\Subtitle;
use App\Post\Domain\Title;
use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;
use App\Post\Application\UseCase\ListPost\ListPostResponse;

class ListPostResponseTest extends TestCase
{
    private $posts = [];

    public function setUp()
    {
        $faker = Faker::create('pt_BR');

        for ($i = 0; $i < 2; $i++) {
            $this->posts[] = Post::fromNativeData(
                $faker->uuid,
                Title::new($faker->title),
                Subtitle::new($faker->title),
                Content::new($faker->realText()),
                Status::draft(),
                new \DateTime,
                new \DateTime
            );
        }
    }

    public function testPosts()
    {
        $listPostResponse = new ListPostResponse($this->posts);
        $posts = $listPostResponse->posts();
        $this->assertEquals($posts, $this->posts);
        $this->assertIsArray($posts);
    }

    public function testJsonSerialize()
    {
        $listPostResponse = new ListPostResponse($this->posts);
        $this->assertIsString(json_encode($listPostResponse));
    }
}
