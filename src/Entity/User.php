<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\UserGroup", inversedBy="users")
     */
    private $userGroup;

    /**
     * @ORM\OneToMany(targetEntity=Checkin::class, mappedBy="scanner")
     */
    private $checkins;

    /**
     * @ORM\OneToMany(targetEntity=IllegalChekinAttempt::class, mappedBy="scanner")
     */
    private $illegalChekinAttempts;

    /**
     * @ORM\OneToMany(targetEntity=StaffCheckin::class, mappedBy="scanner")
     */
    private $staffCheckins;

    /**
     * @ORM\OneToMany(targetEntity=DeletedCheckin::class, mappedBy="scanner")
     */
    private $deletedCheckins;

    public function __construct()
    {
        $this->checkins = new ArrayCollection();
        $this->illegalChekinAttempts = new ArrayCollection();
        $this->staffCheckins = new ArrayCollection();
        $this->deletedCheckins = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

         /**
     * @return Collection|UserGroup[]
     */
    public function getUserGroup(): Collection
    {
        return $this->userGroup;
    }

    public function addUserGroup(UserGroup $userGroup): self
    {
        if (!$this->userGroup->contains($userGroup)) {
            $this->userGroup[] = $userGroup;
        }

        return $this;
    }

    public function removeUserGroup(UserGroup $userGroup): self
    {
        if ($this->userGroup->contains($userGroup)) {
            $this->userGroup->removeElement($userGroup);
        }

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
            $checkin->setScanner($this);
        }

        return $this;
    }

    public function removeCheckin(Checkin $checkin): self
    {
        if ($this->checkins->removeElement($checkin)) {
            // set the owning side to null (unless already changed)
            if ($checkin->getScanner() === $this) {
                $checkin->setScanner(null);
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
            $illegalChekinAttempt->setScanner($this);
        }

        return $this;
    }

    public function removeIllegalChekinAttempt(IllegalChekinAttempt $illegalChekinAttempt): self
    {
        if ($this->illegalChekinAttempts->removeElement($illegalChekinAttempt)) {
            // set the owning side to null (unless already changed)
            if ($illegalChekinAttempt->getScanner() === $this) {
                $illegalChekinAttempt->setScanner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|StaffCheckin[]
     */
    public function getStaffCheckins(): Collection
    {
        return $this->staffCheckins;
    }

    public function addStaffCheckin(StaffCheckin $staffCheckin): self
    {
        if (!$this->staffCheckins->contains($staffCheckin)) {
            $this->staffCheckins[] = $staffCheckin;
            $staffCheckin->setScanner($this);
        }

        return $this;
    }

    public function removeStaffCheckin(StaffCheckin $staffCheckin): self
    {
        if ($this->staffCheckins->removeElement($staffCheckin)) {
            // set the owning side to null (unless already changed)
            if ($staffCheckin->getScanner() === $this) {
                $staffCheckin->setScanner(null);
            }
        }

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
            $deletedCheckin->setScanner($this);
        }

        return $this;
    }

    public function removeDeletedCheckin(DeletedCheckin $deletedCheckin): self
    {
        if ($this->deletedCheckins->removeElement($deletedCheckin)) {
            // set the owning side to null (unless already changed)
            if ($deletedCheckin->getScanner() === $this) {
                $deletedCheckin->setScanner(null);
            }
        }

        return $this;
    }
}
