<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReponseRepository::class)]
class Reponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $textreponse = null;

    #[ORM\Column]
    private ?bool $is_correct = null;

    #[ORM\ManyToOne(inversedBy: 'reponses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?question $idquestion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTextreponse(): ?string
    {
        return $this->textreponse;
    }

    public function setTextreponse(string $textreponse): static
    {
        $this->textreponse = $textreponse;

        return $this;
    }

    public function isCorrect(): ?bool
    {
        return $this->is_correct;
    }

    public function setIsCorrect(bool $is_correct): static
    {
        $this->is_correct = $is_correct;

        return $this;
    }

    public function getIdquestion(): ?question
    {
        return $this->idquestion;
    }

    public function setIdquestion(?question $idquestion): static
    {
        $this->idquestion = $idquestion;

        return $this;
    }
}
