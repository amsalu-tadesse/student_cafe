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
     * @ORM\ManyToOne(targetEntity=Card::class, inversedBy="illegalChekinAttempts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $card;

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
    private $photo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reason;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $barcode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCard(): ?Card
    {
        return $this->card;
    }

    public function setCard(?Card $card): self
    {
        $this->card = $card;

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

    public function getCheckinTime(): ?\DateTimeInterface
    {
        return $this->checkinTime;
    }

    public function setCheckinTime(\DateTimeInterface $checkinTime): self
    {
        $this->checkinTime = $checkinTime;

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
}
