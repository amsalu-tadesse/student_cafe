<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CardRepository::class)
 */
class Card
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
    private $barcode;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="cards")
     */
    private $student;

    /**
     * @ORM\Column(type="datetime")
     */
    private $printdate;

    /**
     * @ORM\OneToMany(targetEntity=DeletedCheckin::class, mappedBy="card")
     */
    private $deletedCheckins;

    public function __construct()
    {
        $this->deletedCheckins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getPrintdate(): ?\DateTimeInterface
    {
        return $this->printdate;
    }

    public function setPrintdate(\DateTimeInterface $printdate): self
    {
        $this->printdate = $printdate;

        return $this;
    }

    /**
     * @return Collection|DeletedCheckin[]
     */
    public function getDeletedCheckins(): Collection
    {
        return $this->deletedCheckins;
    }

    public function addDeletedCheckin(DeletedCheckin $deletedCheckin): self
    {
        if (!$this->deletedCheckins->contains($deletedCheckin)) {
            $this->deletedCheckins[] = $deletedCheckin;
            $deletedCheckin->setCard($this);
        }

        return $this;
    }

    public function removeDeletedCheckin(DeletedCheckin $deletedCheckin): self
    {
        if ($this->deletedCheckins->removeElement($deletedCheckin)) {
            // set the owning side to null (unless already changed)
            if ($deletedCheckin->getCard() === $this) {
                $deletedCheckin->setCard(null);
            }
        }

        return $this;
    }
}
