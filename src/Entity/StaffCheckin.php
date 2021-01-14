<?php

namespace App\Entity;

use App\Repository\StaffCheckinRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StaffCheckinRepository::class)
 */
class StaffCheckin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=StaffCard::class, cascade={"persist", "remove"})
     */
    private $staffCard;


    /**
     * @ORM\Column(type="datetime")
     */
    private $checkinTime;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="staffCheckins")
     */
    private $scanner;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStaffCard(): ?StaffCard
    {
        return $this->staffCard;
    }

    public function setStaffCard(?StaffCard $staffCard): self
    {
        $this->staffCard = $staffCard;

        return $this;
    }

    public function getCheckinTime(): ?\DateTimeInterface
    {
        return $this->checkinTime;
    }

    public function setCheckinTime(\DateTimeInterface $checkinTime): self
    {
        $this->checkinTime = $checkinTime;

        return $this;
    }

    public function getScanner(): ?User
    {
        return $this->scanner;
    }

    public function setScanner(?User $scanner): self
    {
        $this->scanner = $scanner;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
}
