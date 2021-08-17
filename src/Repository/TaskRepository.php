<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class TaskRepository
{
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Task::class);
    }

    public function find(int $id): ?Task
    {
        return $this->repository->find($id);
    }
}
