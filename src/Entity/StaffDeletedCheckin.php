<?php

namespace App\Entity;

use App\Repository\StaffDeletedCheckinRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StaffDeletedCheckinRepository::class)
 */
class StaffDeletedCheckin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=StaffCard::class, inversedBy="staffDeletedCheckins")
     */
    private $staffCard;

   

    /**
     * @ORM\Column(type="datetime")
     */
    private $checkinTime;

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
}
