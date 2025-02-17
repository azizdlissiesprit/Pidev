<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscriptioncours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateinscription = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cours $idcours = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $iduser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateinscription(): ?\DateTimeImmutable
    {
        return $this->dateinscription;
    }

    public function setDateinscription(\DateTimeImmutable $dateinscription): static
    {
        $this->dateinscription = $dateinscription;

        return $this;
    }

    public function getIdcours(): ?Cours
    {
        return $this->idcours;
    }

    public function setIdcours(?Cours $idcours): static
    {
        $this->idcours = $idcours;

        return $this;
    }

    public function getIduser(): ?User
    {
        return $this->iduser;
    }

    public function setIduser(?User $iduser): static
    {
        $this->iduser = $iduser;

        return $this;
    }
}
