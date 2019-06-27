<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssignmentRepository")
 */
class Assignment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Interim", inversedBy="assignments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $interimId;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Contract", inversedBy="assignments")
     */
    private $contractId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rating;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $status;

    public function __construct()
    {
        $this->contractId = new ArrayCollection();
    }

    public function getAssignmentId(): ?int
    {
        return $this->id;
    }

    public function getInterimId(): ?Interim
    {
        return $this->interimId;
    }

    public function setInterimId(?Interim $interimId): self
    {
        $this->interimId = $interimId;

        return $this;
    }

    /**
     * @return Collection|Contract[]
     */
    public function getContractId(): Collection
    {
        return $this->contractId;
    }

    public function addContractId(Contract $contractId): self
    {
        if (!$this->contractId->contains($contractId)) {
            $this->contractId[] = $contractId;
        }

        return $this;
    }

    public function removeContractId(Contract $contractId): self
    {
        if ($this->contractId->contains($contractId)) {
            $this->contractId->removeElement($contractId);
        }

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
