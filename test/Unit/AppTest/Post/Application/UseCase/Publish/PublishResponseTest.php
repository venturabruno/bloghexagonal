<?php

declare(strict_types=1);

namespace Test\Unit\AppTest\Post\Application\UseCase\Publish;

use App\Post\Application\UseCase\Publish\PublishResponse;
use App\Post\Domain\Content;
use App\Post\Domain\Post;
use App\Post\Domain\Status;
use App\Post\Domain\Subtitle;
use App\Post\Domain\Title;
use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;

class PublishResponseTest extends TestCase
{
    private $publishResponse;
    private $id;

    public function setUp()
    {
        $faker = Faker::create('pt_BR');

        $this->id = $faker->uuid;

        $post = Post::fromNativeData(
            $this->id,
            Title::new($faker->title),
            Subtitle::new($faker->title),
            Content::new($faker->realText()),
            Status::draft(),
            new \DateTime,
            new \DateTime
        );

        $this->publishResponse = new PublishResponse($post);
    }

    public function testId()
    {
        $this->assertEquals($this->publishResponse->id(), $this->id);
    }

    public function testStatus()
    {
        $this->assertInstanceOf(Status::class, $this->publishResponse->status());
        $this->assertEquals((string) $this->publishResponse->status(), (string) Status::DRAFT);
    }

    public function testJsonSerialize()
    {
        $json = json_encode([
            'id' => (string) $this->id,
            'status' => (string) Status::DRAFT
        ]);

        $this->assertEquals($json, json_encode($this->publishResponse));
    }
}
