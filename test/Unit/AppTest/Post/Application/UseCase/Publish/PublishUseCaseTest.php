<?php

declare(strict_types=1);

namespace Test\Unit\AppTest\Post\Application\UseCase\Publish;

use App\Post\Application\UseCase\Publish\PublishRequest;
use App\Post\Application\UseCase\Publish\PublishResponse;
use App\Post\Application\UseCase\Publish\PublishUseCase;
use App\Post\Domain\Content;
use App\Post\Domain\Post;
use App\Post\Domain\PostRepository;
use App\Post\Domain\Status;
use App\Post\Domain\Subtitle;
use App\Post\Domain\Title;
use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;

class PublishUseCaseTest extends TestCase
{
    public function testInvoke()
    {
        $faker = Faker::create('pt_BR');
        $id = $faker->uuid;

        $post = Post::fromNativeData(
            $id,
            Title::new($faker->title),
            Subtitle::new($faker->title),
            Content::new($faker->realText()),
            Status::draft(),
            new \DateTime,
            new \DateTime
        );

        $stubPublishRepository = $this->createMock(PostRepository::class);
        $stubPublishRepository->method('find')->willReturn($post);

        $publishRequest = new PublishRequest($id);
        $publishUseCase = new PublishUseCase($stubPublishRepository);
        $publishResponse = $publishUseCase($publishRequest);

        $this->assertInstanceOf(PublishResponse::class, $publishResponse);
        $this->assertEquals($id, $publishResponse->id());
        $this->assertEquals(Status::PUBLISHED, (string) $publishResponse->status());
    }

    /**
     * @expectedException App\Post\Domain\PostDoesNotExistException
     */
    public function testPublishPostDoesNotExist()
    {
        $faker = Faker::create('pt_BR');

        $stubPublishRepository = $this->createMock(PostRepository::class);
        $stubPublishRepository->method('find')->willReturn(null);

        $publishUseCase = new PublishUseCase($stubPublishRepository);
        $publishUseCase(new PublishRequest($faker->uuid));
    }
}
