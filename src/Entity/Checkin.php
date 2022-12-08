<?php

namespace App\Entity;

use App\Repository\CheckinRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CheckinRepository::class)
 */
class Checkin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="datetime")
     */
    private $checkinTime;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="checkins")
     */
    private $scanner;

   

    /**
     * @ORM\ManyToOne(targetEntity=Schedule::class, inversedBy="checkins")
     * @ORM\JoinColumn(nullable=false)
     */
    private $schedule;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="checkins")
     * @ORM\JoinColumn(nullable=false)
     */
    private $student;

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

 

    public function getSchedule(): ?Schedule
    {
        return $this->schedule;
    }

    public function setSchedule(?Schedule $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

}
