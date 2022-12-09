<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\NotificationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotificationRepository::class)]
#[ApiResource]
class Notification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $user_destination_id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_notification = null;

    #[ORM\Column]
    private ?int $accepted_by_user_id = null;

    #[ORM\Column]
    private ?bool $accepted_by_user_destination_id = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateNotification(): ?\DateTimeInterface
    {
        return $this->date_notification;
    }

    public function setDateNotification(\DateTimeInterface $date_notification): self
    {
        $this->date_notification = $date_notification;

        return $this;
    }

    public function getAcceptedByUserId(): ?int
    {
        return $this->accepted_by_user_id;
    }

    public function setAcceptedByUserId(int $accepted_by_user_id): self
    {
        $this->accepted_by_user_id = $accepted_by_user_id;

        return $this;
    }

    public function isAcceptedByUserDestinationId(): ?bool
    {
        return $this->accepted_by_user_destination_id;
    }

    public function setAcceptedByUserDestinationId(bool $accepted_by_user_destination_id): self
    {
        $this->accepted_by_user_destination_id = $accepted_by_user_destination_id;

        return $this;
    }
}
