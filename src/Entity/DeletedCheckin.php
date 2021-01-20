<?php

namespace App\Entity;

use App\Repository\DeletedCheckinRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeletedCheckinRepository::class)
 */
class DeletedCheckin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Card::class, inversedBy="deletedCheckins")
     */
    private $card;

 

    /**
     * @ORM\Column(type="datetime")
     */
    private $checkinTime;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="deletedCheckins")
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

    public function getCard(): ?Card
    {
        return $this->card;
    }

    public function setCard(?Card $card): self
    {
        $this->card = $card;

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
