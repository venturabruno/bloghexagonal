<?php

declare(strict_types=1);

namespace Test\Unit\AppTest\Post\Infrastructure\Handler;

use App\Post\Application\UseCase\Post\PostUseCase;
use App\Post\Infrastructure\Handler\PostHandler;
use App\Post\Infrastructure\Handler\PostHandlerFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;

class PostHandlerFactoryTest extends TestCase
{
    public function testCreatePostFactory()
    {
        $postUseCase = $this->getMockBuilder(PostUseCase::class)
            ->disableOriginalConstructor()
            ->getMock();

        $container = $this->getMockBuilder(Container::class)
            ->setMethods(['get'])
            ->disableOriginalConstructor()
            ->getMock();

        $container->expects($this->once())
            ->method('get')
            ->willReturn($postUseCase);

        $postHandlerFactory = new PostHandlerFactory();
        $postHandler = $postHandlerFactory($container);

        $this->assertInstanceOf(PostHandler::class, $postHandler);
    }
}
