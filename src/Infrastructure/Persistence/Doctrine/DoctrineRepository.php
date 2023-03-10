<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Aggregate\AggregateRoot;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

abstract class DoctrineRepository
{
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function searchAll(string $entity): array
    {
        return $this->repository($entity)->findAll();
    }

    protected function persist(AggregateRoot $entity): void
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    protected function remove(AggregateRoot $entity): void
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    protected function repository(string $entityClass): EntityRepository
    {
        return $this->entityManager->getRepository($entityClass);
    }
}
