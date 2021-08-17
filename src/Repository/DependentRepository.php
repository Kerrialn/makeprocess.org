<?php


declare(strict_types=1);

namespace App\Repository;

use App\Entity\Dependent;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class DependentRepository
{
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Dependent::class);
    }

    public function find(int $id): ?Dependent
    {
        return $this->repository->find($id);
    }
}
