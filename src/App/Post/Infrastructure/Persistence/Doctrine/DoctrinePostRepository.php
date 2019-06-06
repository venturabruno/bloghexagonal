<?php

declare(strict_types=1);

namespace App\Post\Infrastructure\Persistence\Doctrine;

use App\Post\Domain\Post;
use App\Post\Domain\PostRepository;
use Doctrine\ORM\EntityManager;
use App\Core\Domain\UuId;
use App\User\Domain\UserNotFoundException;

class DoctrinePostRepository implements PostRepository
{
    private $entityRepository;
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->entityRepository = $entityManager->getRepository(Post::class);
    }

    public function add(Post $post): void
    {
        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }

    public function get(UuId $id): Post
    {
        return $this->getThrowingException($id);
    }

    public function remove(UuId $id): void
    {
        $post = $this->getThrowingException($id);
        $this->entityManager->remove($post);
        $this->entityManager->flush();
    }

    public function find(UuId $id): ?Post
    {
        return $this->entityRepository->find((string) $id);
    }

    public function save(Post $post): void
    {
        $this->entityManager->transactional(
            function (EntityManager $entityManager) use ($post) {
                $entityManager->persist($post);
            }
        );
    }

    private function getThrowingException(UuId $id): Post
    {
        $post = $this->find($id);
        if ($post instanceof Post) {
            return $post;
        }

        throw new UserNotFoundException();
    }

    public function all(): array
    {
        return $this->entityRepository->findAll();
    }
}
