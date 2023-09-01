<?php

namespace App\Entity;

use App\Repository\ItTicketRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItTicketRepository::class)]
class ItTicket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pcName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $errorCode = null;

    #[ORM\Column(length: 255)]
    private ?string $Localisation = null;

    #[ORM\ManyToOne(inversedBy: 'itTickets')]
    private ?ErrorType $ErrorType = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPcName(): ?string
    {
        return $this->pcName;
    }

    public function setPcName(string $pcName): static
    {
        $this->pcName = $pcName;

        return $this;
    }

    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }

    public function setErrorCode(?string $errorCode): static
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->Localisation;
    }

    public function setLocalisation(string $Localisation): static
    {
        $this->Localisation = $Localisation;

        return $this;
    }

    public function getErrorType(): ?ErrorType
    {
        return $this->ErrorType;
    }

    public function setErrorType(?ErrorType $ErrorType): static
    {
        $this->ErrorType = $ErrorType;

        return $this;
    }
}
