<?php

namespace App\Entity;

use App\Repository\AuthorsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthorsRepository::class)]
class Authors
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    private ?string $last_name = null;

    /**
     * @var Collection<int, Audiobooks>
     */
    #[ORM\OneToMany(targetEntity: Audiobooks::class, mappedBy: 'authors')]
    private Collection $audiobooks;

    public function __construct()
    {
        $this->audiobooks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * @return Collection<int, Audiobooks>
     */
    public function getAudiobooks(): Collection
    {
        return $this->audiobooks;
    }

    public function addAudiobook(Audiobooks $audiobook): static
    {
        if (!$this->audiobooks->contains($audiobook)) {
            $this->audiobooks->add($audiobook);
            $audiobook->setAuthors($this);
        }

        return $this;
    }

    public function removeAudiobook(Audiobooks $audiobook): static
    {
        if ($this->audiobooks->removeElement($audiobook)) {
            // set the owning side to null (unless already changed)
            if ($audiobook->getAuthors() === $this) {
                $audiobook->setAuthors(null);
            }
        }

        return $this;
    }
}
