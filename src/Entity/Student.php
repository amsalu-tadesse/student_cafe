<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
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
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $middleName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $sex;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=255 ,nullable=true)
     */
    private $academicYear;

    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $idNumber;

   

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\OneToMany(targetEntity=Checkin::class, mappedBy="student")
     */
    private $checkins;

    /**
     * @ORM\OneToMany(targetEntity=IllegalChekinAttempt::class, mappedBy="student")
     */
    private $illegalChekinAttempts;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $barcode;



    public function __construct()
    {
        $this->checkins = new ArrayCollection();
        $this->illegalChekinAttempts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function setMiddleName(string $middleName): self
    {
        $this->middleName = $middleName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getAcademicYear(): ?string
    {
        return $this->academicYear;
    }

    public function setAcademicYear(string $academicYear): self
    {
        $this->academicYear = $academicYear;

        return $this;
    }



    public function getIdNumber(): ?string
    {
        return $this->idNumber;
    }

    public function setIdNumber(string $idNumber): self
    {
        $this->idNumber = $idNumber;

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
            $checkin->setStudent($this);
        }

        return $this;
    }

    public function removeCheckin(Checkin $checkin): self
    {
        if ($this->checkins->removeElement($checkin)) {
            // set the owning side to null (unless already changed)
            if ($checkin->getStudent() === $this) {
                $checkin->setStudent(null);
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
            $illegalChekinAttempt->setStudent($this);
        }

        return $this;
    }

    public function removeIllegalChekinAttempt(IllegalChekinAttempt $illegalChekinAttempt): self
    {
        if ($this->illegalChekinAttempts->removeElement($illegalChekinAttempt)) {
            // set the owning side to null (unless already changed)
            if ($illegalChekinAttempt->getStudent() === $this) {
                $illegalChekinAttempt->setStudent(null);
            }
        }

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
