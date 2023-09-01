<?php

namespace App\Entity;

use App\Repository\ErrorTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ErrorTypeRepository::class)]
class ErrorType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lib = null;

    #[ORM\OneToMany(mappedBy: 'ErrorType', targetEntity: ItTicket::class)]
    private Collection $itTickets;

    public function __construct()
    {
        $this->itTickets = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, ItTicket>
     */
    public function getItTickets(): Collection
    {
        return $this->itTickets;
    }

    public function addItTicket(ItTicket $itTicket): static
    {
        if (!$this->itTickets->contains($itTicket)) {
            $this->itTickets->add($itTicket);
            $itTicket->setErrorType($this);
        }

        return $this;
    }

    public function removeItTicket(ItTicket $itTicket): static
    {
        if ($this->itTickets->removeElement($itTicket)) {
            // set the owning side to null (unless already changed)
            if ($itTicket->getErrorType() === $this) {
                $itTicket->setErrorType(null);
            }
        }

        return $this;
    }
}
