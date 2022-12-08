<?php

namespace App\Entity;

use App\Repository\IllegalChekinAttemptRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IllegalChekinAttemptRepository::class)
 */
class IllegalChekinAttempt
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="illegalChekinAttempts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $scanner;

    /**
     * @ORM\Column(type="datetime")
     */
    private $checkinTime;

   

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reason;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $barcode;

    /**
     * @ORM\ManyToOne(targetEntity=Schedule::class, inversedBy="illegalChekinAttempts")
     */
    private $schedule;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="illegalChekinAttempts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $student;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCheckinTime(): ?\DateTimeInterface
    {
        return $this->checkinTime;
    }

    public function setCheckinTime(\DateTimeInterface $checkinTime): self
    {
        $this->checkinTime = $checkinTime;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(?string $barcode): self
    {
        $this->barcode = $barcode;

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
