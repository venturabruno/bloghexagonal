<?php

declare(strict_types=1);

namespace App\Post\Infrastructure\Persistence\Doctrine\Type;

use App\Post\Domain\Content;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

final class PostContentType extends Type
{
    const POST_CONTENT_TYPE = 'post_content_type';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'TEXT';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): Content
    {
        return Content::new($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return (string) $value;
    }

    public function getName()
    {
        return self::POST_CONTENT_TYPE;
    }
}
