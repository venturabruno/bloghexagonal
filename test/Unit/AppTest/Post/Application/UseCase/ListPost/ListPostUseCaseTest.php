<?php

declare(strict_types=1);

namespace Test\Unit\AppTest\Post\Application\UseCase\ListPost;

use App\Post\Application\UseCase\ListPost\ListPostUseCase;
use App\Post\Domain\Content;
use App\Post\Domain\Post;
use App\Post\Domain\PostRepository;
use App\Post\Domain\Status;
use App\Post\Domain\Subtitle;
use App\Post\Domain\Title;
use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;
use App\Post\Application\UseCase\ListPost\ListPostResponse;

class ListPostUseCaseTest extends TestCase
{

    public function testInvoke()
    {
        $faker = Faker::create('pt_BR');

        $post = Post::fromNativeData(
            $faker->uuid,
            Title::new($faker->title),
            Subtitle::new($faker->title),
            Content::new($faker->realText()),
            Status::draft(),
            new \DateTime,
            new \DateTime
        );

        $stubPostRepository = $this->createMock(PostRepository::class);
        $stubPostRepository->method('all')->willReturn([$post]);

        $listPostUseCase = new ListPostUseCase($stubPostRepository);
        $listPostResponse = $listPostUseCase();

        $this->assertInstanceOf(ListPostResponse::class, $listPostResponse);
        $this->assertEquals([$post], $listPostResponse->posts());
    }
}
