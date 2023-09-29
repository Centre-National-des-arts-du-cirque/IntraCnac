<?php

namespace App\Entity;

use App\Repository\VehicleTicketRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleTicketRepository::class)]
class VehicleTicket extends Ticket
{

    #[ORM\Column(length: 10)]
    #[Assert\Regex(
        pattern:'/^([A-HJ-NP-TV-Z]{2}[\s-]{0,1}[0-9]{3}[\s-]{0,1}[A-HJ-NP-TV-Z]{2}|[0-9]{2,4}[\s-]{0,1}[A-Z]{1,3}[\s-]{0,1}[0-9]{2})$/',
        message: 'l immatriculation dois etre au format XX-000-XX ou 0000-XXX-00'
        )]

    private ?string $immatriculation = null;


    #[ORM\Column(length: 255)]
    private ?string $Brand = null;



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
