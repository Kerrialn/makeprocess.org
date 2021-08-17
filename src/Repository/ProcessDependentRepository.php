<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ProcessDependent;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class ProcessDependentRepository
{
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(ProcessDependent::class);
    }

    public function find(int $id): ?ProcessDependent
    {
        return $this->repository->find($id);
    }
}
