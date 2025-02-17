<?php

namespace App\Entity;

use App\Repository\WebinarChatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WebinarChatRepository::class)]
class WebinarChat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?webinar $webinar = null;

    #[ORM\ManyToOne]
    private ?user $user = null;

    #[ORM\Column(length: 255)]
    private ?string $message = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $send_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWebinar(): ?webinar
    {
        return $this->webinar;
    }

    public function setWebinar(?webinar $webinar): static
    {
        $this->webinar = $webinar;

        return $this;
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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getSendAt(): ?\DateTimeImmutable
    {
        return $this->send_at;
    }

    public function setSendAt(\DateTimeImmutable $send_at): static
    {
        $this->send_at = $send_at;

        return $this;
    }
}