<?php

declare(strict_types=1);

namespace App\Post\Infrastructure\Persistence\Doctrine\Type;

use App\Post\Domain\Status;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

final class PostStatusType extends Type
{
    const POST_STATUS_TYPE = 'post_status_type';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'TINYINT';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform) : Status
    {
        return Status::fromNativeData(intval($value));
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform) : int
    {
        return $value->status();
    }

    public function getName()
    {
        return self::POST_STATUS_TYPE;
    }
}
