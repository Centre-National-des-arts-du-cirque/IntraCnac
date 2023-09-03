<?php

namespace App\Entity;

use App\Repository\PrestataireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrestataireRepository::class)]
class Prestataire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tel = null;

    #[ORM\OneToMany(mappedBy: 'heldby', targetEntity: ErrorType::class)]
    private Collection $errorTypes;

    #[ORM\Column(length: 255)]
    private ?string $societyName = null;

    public function __construct()
    {
        $this->errorTypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * @return Collection<int, ErrorType>
     */
    public function getErrorTypes(): Collection
    {
        return $this->errorTypes;
    }

    public function addErrorType(ErrorType $errorType): static
    {
        if (!$this->errorTypes->contains($errorType)) {
            $this->errorTypes->add($errorType);
            $errorType->setHeldby($this);
        }

        return $this;
    }

    public function removeErrorType(ErrorType $errorType): static
    {
        if ($this->errorTypes->removeElement($errorType)) {
            // set the owning side to null (unless already changed)
            if ($errorType->getHeldby() === $this) {
                $errorType->setHeldby(null);
            }
        }

        return $this;
    }

    public function getSocietyName(): ?string
    {
        return $this->societyName;
    }

    public function setSocietyName(string $societyName): static
    {
        $this->societyName = $societyName;

        return $this;
    }
}
