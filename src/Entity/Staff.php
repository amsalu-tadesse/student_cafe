<?php

namespace App\Entity;

use App\Repository\StaffRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StaffRepository::class)
 */
class Staff
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=StaffCard::class, mappedBy="staff")
     */
    private $staffCards;

    public function __construct()
    {
        $this->staffCards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|StaffCard[]
     */
    public function getStaffCards(): Collection
    {
        return $this->staffCards;
    }

    public function addStaffCard(StaffCard $staffCard): self
    {
        if (!$this->staffCards->contains($staffCard)) {
            $this->staffCards[] = $staffCard;
            $staffCard->setStaff($this);
        }

        return $this;
    }

    public function removeStaffCard(StaffCard $staffCard): self
    {
        if ($this->staffCards->removeElement($staffCard)) {
            // set the owning side to null (unless already changed)
            if ($staffCard->getStaff() === $this) {
                $staffCard->setStaff(null);
            }
        }

        return $this;
    }
}
