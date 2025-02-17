<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $textquestion = null;

    #[ORM\Column(length: 255)]
    private ?string $typequestion = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?quizlesson $idquiz = null;

    /**
     * @var Collection<int, Reponse>
     */
    #[ORM\OneToMany(targetEntity: Reponse::class, mappedBy: 'idquestion', orphanRemoval: true)]
    private Collection $reponses;

    public function __construct()
    {
        $this->reponses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTextquestion(): ?string
    {
        return $this->textquestion;
    }

    public function setTextquestion(string $textquestion): static
    {
        $this->textquestion = $textquestion;

        return $this;
    }

    public function getTypequestion(): ?string
    {
        return $this->typequestion;
    }

    public function setTypequestion(string $typequestion): static
    {
        $this->typequestion = $typequestion;

        return $this;
    }

    public function getIdquiz(): ?quizlesson
    {
        return $this->idquiz;
    }

    public function setIdquiz(?quizlesson $idquiz): static
    {
        $this->idquiz = $idquiz;

        return $this;
    }

    /**
     * @return Collection<int, Reponse>
     */
    public function getReponses(): Collection
    {
        return $this->reponses;
    }

    public function addReponse(Reponse $reponse): static
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses->add($reponse);
            $reponse->setIdquestion($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): static
    {
        if ($this->reponses->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getIdquestion() === $this) {
                $reponse->setIdquestion(null);
            }
        }

        return $this;
    }
}
