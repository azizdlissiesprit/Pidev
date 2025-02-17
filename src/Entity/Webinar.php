<?php

namespace App\Entity;

use App\Repository\WebinarRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WebinarRepository::class)]
#[ORM\HasLifecycleCallbacks] 
class Webinar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne]
    private ?User $presenter = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $debut = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column(length: 255)]
    private ?string $tags = null;

    #[ORM\Column]
    private ?bool $registration_required = null;

    #[ORM\Column]
    private ?int $max_attendees = null;

    #[ORM\Column(length: 255)]
    private ?string $platform = null;

    #[ORM\Column(length: 255)]
    private ?string $lien = null;

    #[ORM\Column]
    private ?bool $recording_avaible = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdat = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedat = null;

    // Lifecycle Callback to set createdAt and updatedAt automatically
    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdat = new \DateTime(); // Sets created date
        $this->updatedat = new \DateTime(); // Ensures updated date is initialized
    }

    // Lifecycle Callback to update updatedAt automatically on modification
    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): void
    {
        $this->updatedat = new \DateTime();
    }

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getPresenter(): ?User
    {
        return $this->presenter;
    }

    public function setPresenter(?User $presenter): static
    {
        $this->presenter = $presenter;
        return $this;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): static
    {
        $this->debut = $debut;
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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;
        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(string $tags): static
    {
        $this->tags = $tags;
        return $this;
    }

    public function isRegistrationRequired(): ?bool
    {
        return $this->registration_required;
    }

    public function setRegistrationRequired(bool $registration_required): static
    {
        $this->registration_required = $registration_required;
        return $this;
    }

    public function getMaxAttendees(): ?int
    {
        return $this->max_attendees;
    }

    public function setMaxAttendees(int $max_attendees): static
    {
        $this->max_attendees = $max_attendees;
        return $this;
    }

    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    public function setPlatform(string $platform): static
    {
        $this->platform = $platform;
        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): static
    {
        $this->lien = $lien;
        return $this;
    }

    public function isRecordingAvaible(): ?bool
    {
        return $this->recording_avaible;
    }

    public function setRecordingAvaible(bool $recording_avaible): static
    {
        $this->recording_avaible = $recording_avaible;
        return $this;
    }

    public function getCreatedat(): ?\DateTimeInterface
    {
        return $this->createdat;
    }

    public function getUpdatedat(): ?\DateTimeInterface
    {
        return $this->updatedat;
    }
}