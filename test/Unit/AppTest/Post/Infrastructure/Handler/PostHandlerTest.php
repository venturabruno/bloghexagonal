<?php

declare(strict_types=1);

namespace Test\Unit\AppTest\Post\Infrastructure\Handler;

use App\Post\Application\UseCase\Post\PostResponse;
use App\Post\Application\UseCase\Post\PostUseCase;
use App\Post\Domain\Content;
use App\Post\Domain\Subtitle;
use App\Post\Infrastructure\Handler\PostHandler;
use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;
use App\Post\Domain\Post;
use App\Post\Domain\Status;
use App\Post\Domain\Title;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ServerRequest;

class PostHandlerTest extends TestCase
{
    private $uuid;
    private $title;
    private $subtitle;
    private $content;

    public function setUp()
    {
        $faker = Faker::create('pt_BR');

        $this->uuid = $faker->uuid;
        $this->title = $faker->text;
        $this->subtitle = $faker->text;
        $this->content = $faker->realText();
    }

    private function mockPost()
    {
        return Post::fromNativeData(
            $this->uuid,
            Title::new($this->title),
            Subtitle::new($this->subtitle),
            Content::new($this->content),
            Status::draft(),
            new \DateTime,
            new \DateTime
        );
    }

    private function mockPostUseCase()
    {
        $postResponse = new PostResponse($this->mockPost());

        $postUseCase = $this->getMockBuilder(PostUseCase::class)
            ->setMethods(['__invoke'])
            ->disableOriginalConstructor()
            ->getMock();

        $postUseCase->expects($this->once())
            ->method('__invoke')
            ->willReturn($postResponse);

        return $postUseCase;
    }

    private function mockServerRequest(array $return)
    {
        $serverRequest = $this->getMockBuilder(ServerRequest::class)
            ->setMethods(['getParsedBody'])
            ->disableOriginalConstructor()
            ->getMock();

        $serverRequest->expects($this->once())
            ->method('getParsedBody')
            ->willReturn($return);

        return $serverRequest;
    }

    public function testCreatePost()
    {
        $serverRequest = $this->mockServerRequest([
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'content' => $this->content
        ]);

        $postHandler = new PostHandler($this->mockPostUseCase());
        $response = $postHandler->handle($serverRequest);

        $json = json_decode((string) $response->getBody());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($this->title, $json->title);
        $this->assertEquals($this->subtitle, $json->subtitle);
        $this->assertEquals($this->content, $json->content);
    }

    public function testCreatePostWithoutTitle()
    {
        $serverRequest = $this->mockServerRequest([
            'title' => '',
            'subtitle' => '',
            'content' => ''
        ]);

        $postUseCase = $this->getMockBuilder(PostUseCase::class)
            ->disableOriginalConstructor()
            ->getMock();

        $postHandler = new PostHandler($postUseCase);
        $response = $postHandler->handle($serverRequest);
        $json = json_decode((string) $response->getBody());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertContains("Title is empty", $json);
    }
}
