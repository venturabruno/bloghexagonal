<?php

declare(strict_types=1);

namespace Test\Unit\AppTest\Post\Application\UseCase\Publish;

use App\Post\Application\UseCase\Publish\PublishRequest;
use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;

class PublishRequestTest extends TestCase
{
    private $postRequest;
    private $id;

    public function setUp()
    {
        $faker = Faker::create('pt_BR');

        $this->id = $faker->uuid;

        $this->postRequest = new PublishRequest($this->id);
    }

    public function testId()
    {
        $this->assertEquals($this->postRequest->id(), $this->id);
    }
}
