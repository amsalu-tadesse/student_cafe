<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScheduleRepository::class)
 */
class Schedule
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
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

   

    /**
     * @ORM\OneToMany(targetEntity=Checkin::class, mappedBy="schedule")
     */
    private $checkins;

    /**
     * @ORM\OneToMany(targetEntity=IllegalChekinAttempt::class, mappedBy="schedule")
     */
    private $illegalChekinAttempts;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $status;

  

    public function __construct()
    {
        $this->checkins = new ArrayCollection();
        $this->illegalChekinAttempts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }
    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    
    /**
     * @return Collection|Checkin[]
     */
    public function getCheckins(): Collection
    {
        return $this->checkins;
    }

    public function addCheckin(Checkin $checkin): self
    {
        if (!$this->checkins->contains($checkin)) {
            $this->checkins[] = $checkin;
            $checkin->setSchedule($this);
        }

        return $this;
    }

    public function removeCheckin(Checkin $checkin): self
    {
        if ($this->checkins->removeElement($checkin)) {
            // set the owning side to null (unless already changed)
            if ($checkin->getSchedule() === $this) {
                $checkin->setSchedule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|IllegalChekinAttempt[]
     */
    public function getIllegalChekinAttempts(): Collection
    {
        return $this->illegalChekinAttempts;
    }

    public function addIllegalChekinAttempt(IllegalChekinAttempt $illegalChekinAttempt): self
    {
        if (!$this->illegalChekinAttempts->contains($illegalChekinAttempt)) {
            $this->illegalChekinAttempts[] = $illegalChekinAttempt;
            $illegalChekinAttempt->setSchedule($this);
        }

        return $this;
    }

    public function removeIllegalChekinAttempt(IllegalChekinAttempt $illegalChekinAttempt): self
    {
        if ($this->illegalChekinAttempts->removeElement($illegalChekinAttempt)) {
            // set the owning side to null (unless already changed)
            if ($illegalChekinAttempt->getSchedule() === $this) {
                $illegalChekinAttempt->setSchedule(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

}
