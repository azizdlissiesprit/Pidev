<?php

namespace App\Entity;

use App\Repository\ReviewsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewsRepository::class)]
class Reviews
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $rating = null;

    #[ORM\Column(length: 255)]
    private ?string $review = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $datecreation = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    private ?cours $idcours = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getReview(): ?string
    {
        return $this->review;
    }

    public function setReview(string $review): static
    {
        $this->review = $review;

        return $this;
    }

    public function getDatecreation(): ?\DateTimeImmutable
    {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTimeImmutable $datecreation): static
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function getIdcours(): ?cours
    {
        return $this->idcours;
    }

    public function setIdcours(?cours $idcours): static
    {
        $this->idcours = $idcours;

        return $this;
    }
}
