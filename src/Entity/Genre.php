<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Audiobooks>
     */
    #[ORM\OneToMany(targetEntity: Audiobooks::class, mappedBy: 'genre')]
    private Collection $audiobooks;

    public function __construct()
    {
        $this->audiobooks = new ArrayCollection();
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
            $audiobook->setGenre($this);
        }

        return $this;
    }

    public function removeAudiobook(Audiobooks $audiobook): static
    {
        if ($this->audiobooks->removeElement($audiobook)) {
            // set the owning side to null (unless already changed)
            if ($audiobook->getGenre() === $this) {
                $audiobook->setGenre(null);
            }
        }

        return $this;
    }
}
