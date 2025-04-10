<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Manga>
     */
    #[ORM\ManyToMany(targetEntity: Manga::class, inversedBy: 'tags')]
    private Collection $mangas;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdat = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\PrePersist]
    public function setTimestampsValue(): void
    {
        if ($this->createdat == null) {
            $this->createdat = new \DateTimeImmutable();
        }
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function __construct()
    {
        $this->mangas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Manga>
     */
    public function getMangas(): Collection
    {
        return $this->mangas;
    }

    public function addManga(Manga $manga): static
    {
        if (!$this->mangas->contains($manga)) {
            $this->mangas->add($manga);
        }

        return $this;
    }

    public function removeManga(Manga $manga): static
    {
        $this->mangas->removeElement($manga);

        return $this;
    }

    public function getCreatedat(): ?\DateTimeImmutable
    {
        return $this->createdat;
    }

    public function setCreatedat(\DateTimeImmutable $createdat): static
    {
        $this->createdat = $createdat;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
