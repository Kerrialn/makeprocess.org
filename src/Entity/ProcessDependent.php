<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeImmutable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Uid\Uuid;

#[ApiResource(
    collectionOperations: ['get', 'post'],
    itemOperations: ['get', 'patch', 'put'],
)]
#[Entity]
class ProcessDependent
{
    #[Id]
    #[Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[ManyToOne(targetEntity: Process::class, inversedBy: 'dependents')]
    private ?Process $process;

    #[ManyToOne(targetEntity: Dependent::class)]
    private ?Dependent $dependent;

    #[Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getProcess(): ?Process
    {
        return $this->process;
    }

    public function setProcess(?Process $process): void
    {
        $this->process = $process;
    }

    public function getDependent(): ?Dependent
    {
        return $this->dependent;
    }

    public function setDependent(?Dependent $dependent): void
    {
        $this->dependent = $dependent;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
