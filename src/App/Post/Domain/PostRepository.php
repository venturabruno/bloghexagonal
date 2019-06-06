<?php

declare(strict_types=1);

namespace App\Post\Domain;

use App\Core\Domain\UuId;

interface PostRepository
{
    public function add(Post $post): void;

    public function find(UuId $id): ?Post;

    public function remove(UuId $id): void;

    public function save(Post $post): void;

    public function all(): array;
}
