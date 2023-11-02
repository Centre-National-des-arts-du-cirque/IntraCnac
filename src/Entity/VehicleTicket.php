<?php

namespace App\Entity;

use App\Repository\VehicleTicketRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleTicketRepository::class)]
class VehicleTicket extends Ticket
{

    #[ORM\Column(length: 10)]
    private ?string $immatriculation = null;


    #[ORM\Column(length: 255)]
    private ?string $Brand = null;

    public function getId(): ?int
    {
        return parent::getId();
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): static
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }



    public function getBrand(): ?string
    {
        return $this->Brand;
    }

    public function setBrand(string $Brand): static
    {
        $this->Brand = $Brand;

        return $this;
    }
}
