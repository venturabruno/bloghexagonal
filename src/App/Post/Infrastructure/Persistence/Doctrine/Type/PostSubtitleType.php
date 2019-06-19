<?php

declare(strict_types=1);

namespace App\Post\Infrastructure\Persistence\Doctrine\Type;

use App\Post\Domain\Subtitle;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

final class PostSubtitleType extends Type
{
    const POST_SUBTITLE_TYPE = 'post_subtitle_type';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'VARCHAR(255)';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform) : Subtitle
    {
        return Subtitle::new($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform) : string
    {
        return (string) $value;
    }

    public function getName()
    {
        return self::POST_SUBTITLE_TYPE;
    }
}
