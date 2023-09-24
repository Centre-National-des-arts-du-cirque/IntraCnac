<?php

namespace App\Entity;

use App\Repository\BuildingTicketRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BuildingTicketRepository::class)]
class BuildingTicket extends Ticket
{



    #[ORM\Column(length: 255)]
    private ?string $site = null;

    #[ORM\Column(length: 255)]
    private ?string $Localisation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(string $site): static
    {
        $this->site = $site;

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
}
