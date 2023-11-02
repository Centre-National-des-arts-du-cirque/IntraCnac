<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lib = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateBeg = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateEnd = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    private ?TypeEvent $TypeEvent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLib(): ?string
    {
        return $this->lib;
    }

    public function setLib(string $lib): static
    {
        $this->lib = $lib;

        return $this;
    }

    public function getDateBeg(): ?\DateTimeInterface
    {
        return $this->DateBeg;
    }

    public function setDateBeg(\DateTimeInterface $DateBeg): static
    {
        $this->DateBeg = $DateBeg;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->DateEnd;
    }

    public function setDateEnd(\DateTimeInterface $DateEnd): static
    {
        $this->DateEnd = $DateEnd;

        return $this;
    }

    public function getTypeEvent(): ?TypeEvent
    {
        return $this->TypeEvent;
    }

    public function setTypeEvent(?TypeEvent $TypeEvent): static
    {
        $this->TypeEvent = $TypeEvent;

        return $this;
    }
}
