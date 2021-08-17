<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Uid\Uuid;

#[ApiResource(
    collectionOperations: ['get', 'post'],
    itemOperations: ['get', 'patch', 'put'],
)]
#[ApiFilter(SearchFilter::class, properties: [
    'title' => 'partial',
])]
#[Entity]
class Process
{
    #[Id]
    #[Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[Column(type: 'uuid', unique: true)]
    private Uuid $slug;

    #[Column(type: 'string', length: 255)]
    private string $title;

    #[Column(type: 'text', nullable: true)]
    private ?string $description;

    #[OneToMany(mappedBy: 'process', targetEntity: Task::class)]
    private Collection $tasks;

    #[OneToMany(mappedBy: 'process', targetEntity: ProcessDependent::class)]
    private Collection $dependents;

    #[Column(type: 'float')]
    private float $version = 0.1;

    #[Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    #[OneToMany(mappedBy: 'process', targetEntity: Comment::class)]
    private Collection $comments;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->slug = Uuid::v4();
        $this->tasks = new ArrayCollection();
        $this->dependents = new ArrayCollection();
        $this->createdAt = new DateTimeImmutable();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getSlug(): ?Uuid
    {
        return $this->slug;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Collection|Task[]
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): void
    {
        if (! $this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setProcess($this);
        }
    }

    public function removeTask(Task $task): void
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getProcess() === $this) {
                $task->setProcess(null);
            }
        }
    }

    /**
     * @return Collection|ProcessDependent[]
     */
    public function getDependents(): Collection
    {
        return $this->dependents;
    }

    public function addDependent(ProcessDependent $dependent): void
    {
        if (! $this->dependents->contains($dependent)) {
            $this->dependents[] = $dependent;
            $dependent->setProcess($this);
        }
    }

    public function removeDependent(ProcessDependent $dependent): void
    {
        if ($this->dependents->removeElement($dependent)) {
            // set the owning side to null (unless already changed)
            if ($dependent->getProcess() === $this) {
                $dependent->setProcess(null);
            }
        }
    }

    public function getVersion(): ?float
    {
        return $this->version;
    }

    public function setVersion(float $version): void
    {
        $this->version = $version;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): void
    {
        if (! $this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setProcess($this);
        }
    }

    public function removeComment(Comment $comment): void
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getProcess() === $this) {
                $comment->setProcess(null);
            }
        }
    }
}
