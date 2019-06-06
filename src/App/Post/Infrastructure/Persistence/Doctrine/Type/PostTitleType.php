<?php

declare(strict_types=1);

namespace App\Post\Infrastructure\Persistence\Doctrine\Type;

use App\Post\Domain\Title;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

final class PostTitleType extends Type
{
    const POST_TITLE_TYPE = 'post_title_type';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'VARCHAR(255)';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform) : Title
    {
        return Title::new($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform) : string
    {
        return (string) $value;
    }

    public function getName()
    {
        return self::POST_TITLE_TYPE;
    }
}
