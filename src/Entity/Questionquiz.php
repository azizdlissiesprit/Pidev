<?php

namespace App\Entity;

use App\Repository\QuestionquizRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionquizRepository::class)]
class Questionquiz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Quiz::class, inversedBy: 'questionquizzes')]
    #[ORM\JoinColumn(name: 'id_quiz', referencedColumnName: 'id')]
    private ?Quiz $quiz = null;
    
    #[ORM\Column(nullable: true)]
    private ?int $id_quiz = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $question = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type_question = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $option_1 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $option_2 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $option_3 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $option_4 = null;

    #[ORM\Column(nullable: true)]
    private ?int $bonne_reponse = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $explication = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_creation = null;

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): self
    {
        $this->quiz = $quiz;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdQuiz(): ?int
    {
        return $this->id_quiz;
    }

    public function setIdQuiz(?int $id_quiz): static
    {
        $this->id_quiz = $id_quiz;

        return $this;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(?string $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getTypeQuestion(): ?string
    {
        return $this->type_question;
    }

    public function setTypeQuestion(?string $type_question): static
    {
        $this->type_question = $type_question;

        return $this;
    }

    public function getOption1(): ?string
    {
        return $this->option_1;
    }

    public function setOption1(?string $option_1): static
    {
        $this->option_1 = $option_1;

        return $this;
    }

    public function getOption2(): ?string
    {
        return $this->option_2;
    }

    public function setOption2(?string $option_2): static
    {
        $this->option_2 = $option_2;

        return $this;
    }

    public function getOption3(): ?string
    {
        return $this->option_3;
    }

    public function setOption3(?string $option_3): static
    {
        $this->option_3 = $option_3;

        return $this;
    }

    public function getOption4(): ?string
    {
        return $this->option_4;
    }

    public function setOption4(?string $option_4): static
    {
        $this->option_4 = $option_4;

        return $this;
    }

    public function getBonneReponse(): ?int
    {
        return $this->bonne_reponse;
    }

    public function setBonneReponse(?int $bonne_reponse): static
    {
        $this->bonne_reponse = $bonne_reponse;

        return $this;
    }

    public function getExplication(): ?string
    {
        return $this->explication;
    }

    public function setExplication(?string $explication): static
    {
        $this->explication = $explication;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(?\DateTimeInterface $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }
}
