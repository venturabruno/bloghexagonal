<?php

declare(strict_types=1);

namespace Test\Unit\AppTest\Post\Application\UseCase\Post;

use App\Post\Application\UseCase\Post\PostRequest;
use App\Post\Application\UseCase\Post\PostResponse;
use App\Post\Application\UseCase\Post\PostUseCase;
use App\Post\Domain\Content;
use App\Post\Domain\Post;
use App\Post\Domain\PostRepository;
use App\Post\Domain\Status;
use App\Post\Domain\Subtitle;
use App\Post\Domain\Title;
use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;

class PostUseCaseTest extends TestCase
{

    public function testInvoke()
    {
        $faker = Faker::create('pt_BR');

        $title = $faker->title;
        $subtitle = $faker->title;
        $content = $faker->realText();

        $post = Post::fromNativeData(
            $faker->uuid,
            Title::new($title),
            Subtitle::new($subtitle),
            Content::new($content),
            Status::draft(),
            new \DateTime,
            new \DateTime
        );

        $stubPostRepository = $this->createMock(PostRepository::class);
        $stubPostRepository->method('add')->willReturn($post);

        $postRequest = new PostRequest($title, $subtitle, $content);
        $postUseCase = new PostUseCase($stubPostRepository);
        $postResponse = $postUseCase($postRequest);

        $this->assertInstanceOf(PostResponse::class, $postResponse);
        $this->assertEquals($title, $postResponse->title());
        $this->assertEquals($subtitle, $postResponse->subtitle());
        $this->assertEquals($content, $postResponse->content());
    }
}
