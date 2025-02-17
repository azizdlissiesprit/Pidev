<?php

namespace App\Entity;

use App\Repository\ReponsequizRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

#[ORM\Entity(repositoryClass: ReponsequizRepository::class)]
class Reponsequiz
{
   #[ORM\Id]
   #[ORM\GeneratedValue]
   #[ORM\Column(name: "id_rep")]
   private ?int $id_rep = null;

   #[ORM\Column]
   private ?int $id_question = null;

   #[ORM\Column]
   private ?int $reponse_choisie = null;

   #[ORM\Column]
   private ?bool $est_correcte = null;

   #[ORM\ManyToOne(targetEntity: User::class)]
   #[ORM\JoinColumn(name: 'id_utilisateur', referencedColumnName: 'id')]
   private ?User $utilisateur = null;

   #[ORM\Column(type: Types::DATETIME_MUTABLE)]
   private ?\DateTimeInterface $date_reponse = null;

   #[ORM\Column(nullable: false)]
   private int $points = 0;

   public function getIdRep(): ?int
   {
       return $this->id_rep;
   }

   public function setIdRep(int $id_rep): self
   {
       $this->id_rep = $id_rep;
       return $this;
   }

   public function getIdQuestion(): ?int
   {
       return $this->id_question;
   }

   public function setIdQuestion(int $id_question): self
   {
       $this->id_question = $id_question;
       return $this;
   }

   public function getReponseChoisie(): ?int
   {
       return $this->reponse_choisie;
   }

   public function setReponseChoisie(int $reponse_choisie): self
   {
       $this->reponse_choisie = $reponse_choisie;
       return $this;
   }

   public function getEstCorrecte(): ?bool
   {
       return $this->est_correcte;
   }

   public function setEstCorrecte(bool $est_correcte): self
   {
       $this->est_correcte = $est_correcte;
       return $this;
   }

   public function getUtilisateur(): ?User
   {
       return $this->utilisateur;
   }

   public function setUtilisateur(?User $utilisateur): self
   {
       $this->utilisateur = $utilisateur;
       return $this;
   }

   public function getDateReponse(): ?\DateTimeInterface
   {
       return $this->date_reponse;
   }

   public function setDateReponse(\DateTimeInterface $date_reponse): self
   {
       $this->date_reponse = $date_reponse;
       return $this;
   }

   public function getPoints(): ?int
   {
       return $this->points;
   }

   public function setPoints(int $points): self
   {
       $this->points = $points;
       return $this;
   }
}
