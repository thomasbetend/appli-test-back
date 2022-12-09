<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
#[ApiResource]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[ORM\Column]
    private ?int $user_destination_id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_message = null;

    #[ORM\Column]
    private ?bool $seen_by_user_destination = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getUserDestinationId(): ?int
    {
        return $this->user_destination_id;
    }

    public function setUserDestinationId(int $user_destination_id): self
    {
        $this->user_destination_id = $user_destination_id;

        return $this;
    }

    public function getDateMessage(): ?\DateTimeInterface
    {
        return $this->date_message;
    }

    public function setDateMessage(\DateTimeInterface $date_message): self
    {
        $this->date_message = $date_message;

        return $this;
    }

    public function isSeenByUserDestination(): ?bool
    {
        return $this->seen_by_user_destination;
    }

    public function setSeenByUserDestination(bool $seen_by_user_destination): self
    {
        $this->seen_by_user_destination = $seen_by_user_destination;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
