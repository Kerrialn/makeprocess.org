<?php


declare(strict_types=1);

namespace App\Repository;

use App\Entity\Process;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class ProcessRepository
{
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Process::class);
    }

    public function find(int $id): ?Process
    {
        return $this->repository->find($id);
    }
}
