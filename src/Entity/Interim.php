<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InterimRepository")
 */
class Interim
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $interimId;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contract", mappedBy="interimId", orphanRemoval=true)
     */
    private $contracts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Assignment", mappedBy="interimId", orphanRemoval=true)
     */
    private $assignments;

    public function __construct()
    {
        $this->contracts = new ArrayCollection();
        $this->assignments = new ArrayCollection();
    }

    public function getInterimId(): ?int
    {
        return $this->interimId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(?int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection|Contract[]
     */
    public function getContracts(): Collection
    {
        return $this->contracts;
    }

    public function addContract(Contract $contract): self
    {
        if (!$this->contracts->contains($contract)) {
            $this->contracts[] = $contract;
            $contract->setInterimId($this);
        }

        return $this;
    }

    public function removeContract(Contract $contract): self
    {
        if ($this->contracts->contains($contract)) {
            $this->contracts->removeElement($contract);
            // set the owning side to null (unless already changed)
            if ($contract->getInterimId() === $this) {
                $contract->setInterimId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Assignment[]
     */
    public function getAssignments(): Collection
    {
        return $this->assignments;
    }

    public function addAssignment(Assignment $assignment): self
    {
        if (!$this->assignments->contains($assignment)) {
            $this->assignments[] = $assignment;
            $assignment->setInterimId($this);
        }

        return $this;
    }

    public function removeAssignment(Assignment $assignment): self
    {
        if ($this->assignments->contains($assignment)) {
            $this->assignments->removeElement($assignment);
            // set the owning side to null (unless already changed)
            if ($assignment->getInterimId() === $this) {
                $assignment->setInterimId(null);
            }
        }

        return $this;
    }
}
