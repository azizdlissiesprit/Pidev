<?php

namespace App\Entity;

use App\Repository\BadgesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BadgesRepository::class)]
class Badges
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?user $user = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $typebadge = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbrstars = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getTypebadge(): ?string
    {
        return $this->typebadge;
    }

    public function setTypebadge(?string $typebadge): static
    {
        $this->typebadge = $typebadge;

        return $this;
    }

    public function getNbrstars(): ?int
    {
        return $this->nbrstars;
    }

    public function setNbrstars(?int $nbrstars): static
    {
        $this->nbrstars = $nbrstars;

        return $this;
    }
}
