<?php

declare(strict_types=1);

namespace Test\Unit\AppTest\Post\Domain;

use PHPUnit\Framework\TestCase;
use App\Post\Domain\Status;

class StatusTest extends TestCase
{
    public function testFromNativeData()
    {
        $status = Status::fromNativeData(Status::published()->status());

        $this->assertInstanceOf(Status::class, $status);
        $this->assertEquals($status->status(), (integer) Status::published()->status());
    }

    public function testPublished()
    {
        $this->assertInstanceOf(Status::class, Status::published());
    }

    public function testDraft()
    {
        $this->assertInstanceOf(Status::class, Status::draft());
    }

    public function testEqualsTo()
    {
        $status = Status::published();
        $this->assertTrue($status->equalsTo(Status::published()));
    }

    public function testStatus()
    {
        $status = Status::published();
        $this->assertEquals((string) Status::PUBLISHED, $status->status());
    }

    public function testString()
    {
        $status = Status::published();
        $this->assertEquals((string) Status::PUBLISHED, (string) $status);
    }
}
