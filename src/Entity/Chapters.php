<?php

namespace App\Entity;

use App\Repository\ChaptersRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



#[ORM\Entity(repositoryClass: ChaptersRepository::class)]
#[Vich\Uploadable]

class Chapters
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $chapter_order = null;

    #[ORM\Column]
    private ?int $duration = null;



    #[Vich\UploadableField(mapping: 'chapters_audios', fileNameProperty: 'audioFilename')]
    private ?File $audioFile = null;

    #[ORM\Column(nullable: true)]
    private $audioFilename;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;







    #[ORM\ManyToOne(inversedBy: 'chapters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Audiobooks $audiobooks = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getChapterOrder(): ?int
    {
        return $this->chapter_order;
    }

    public function setChapterOrder(int $chapter_order): static
    {
        $this->chapter_order = $chapter_order;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }



    #VICHUPLOADER STARTS

    public function getAudioFile(): ?File
    {
        return $this->audioFile;
    }


    public function setAudioFile(?File $audioFile = null): void
    {
        $this->audioFile = $audioFile;

        if (null !== $audioFile) {
            $this->updatedAt = new \DateTimeImmutable();
          
        }
    }


    public function getAudioFilename(): ?string
    {
        return $this->audioFilename;
    }


    public function setAudioFilename(?string $audioFilename): void
    {
        $this->audioFilename = $audioFilename;
    }


    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    
    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }



    #VICHUPLOADER ENDS



    public function getAudiobooks(): ?Audiobooks
    {
        return $this->audiobooks;
    }

    public function setAudiobooks(?Audiobooks $audiobooks): static
    {
        $this->audiobooks = $audiobooks;

        return $this;
    }
}
