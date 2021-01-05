<?php

namespace App\Entity;

use App\Repository\StaffCardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StaffCardRepository::class)
 */
class StaffCard
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Staff::class, inversedBy="staffCards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $staff;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $barcode;

    /**
     * @ORM\Column(type="datetime")
     */
    private $printDate;

    /**
     * @ORM\OneToMany(targetEntity=StaffDeletedCheckin::class, mappedBy="staffCard")
     */
    private $staffDeletedCheckins;

    public function __construct()
    {
        $this->staffDeletedCheckins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStaff(): ?Staff
    {
        return $this->staff;
    }

    public function setStaff(?Staff $staff): self
    {
        $this->staff = $staff;

        return $this;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(string $barcode): self
    {
        $this->barcode = $barcode;

        return $this;
    }

    public function getPrintDate(): ?\DateTimeInterface
    {
        return $this->printDate;
    }

    public function setPrintDate(\DateTimeInterface $printDate): self
    {
        $this->printDate = $printDate;

        return $this;
    }

    /**
     * @return Collection|StaffDeletedCheckin[]
     */
    public function getStaffDeletedCheckins(): Collection
    {
        return $this->staffDeletedCheckins;
    }

    public function addStaffDeletedCheckin(StaffDeletedCheckin $staffDeletedCheckin): self
    {
        if (!$this->staffDeletedCheckins->contains($staffDeletedCheckin)) {
            $this->staffDeletedCheckins[] = $staffDeletedCheckin;
            $staffDeletedCheckin->setStaffCard($this);
        }

        return $this;
    }

    public function removeStaffDeletedCheckin(StaffDeletedCheckin $staffDeletedCheckin): self
    {
        if ($this->staffDeletedCheckins->removeElement($staffDeletedCheckin)) {
            // set the owning side to null (unless already changed)
            if ($staffDeletedCheckin->getStaffCard() === $this) {
                $staffDeletedCheckin->setStaffCard(null);
            }
        }

        return $this;
    }
}
