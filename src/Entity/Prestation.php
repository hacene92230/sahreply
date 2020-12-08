<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrestationRepository::class)
 */
class Prestation
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
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbheure;

    /*

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="prestation")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=PrestationType::class, mappedBy="prestation")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=PrestationStatut::class, mappedBy="prestation")
     */
    private $statut;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="prestation")
     */
    private $users;
    

    public function __construct()
    {
        $this->type = new ArrayCollection();
        $this->statut = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getNbheure(): ?int
    {
        return $this->nbheure;
    }

    public function setNbheure(int $nbheure): self
    {
        $this->nbheure = $nbheure;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|PrestationType[]
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(PrestationType $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type[] = $type;
            $type->setPrestation($this);
        }

        return $this;
    }

    public function removeType(PrestationType $type): self
    {
        if ($this->type->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getPrestation() === $this) {
                $type->setPrestation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PrestationStatut[]
     */
    public function getStatut(): Collection
    {
        return $this->statut;
    }

    public function addStatut(PrestationStatut $statut): self
    {
        if (!$this->statut->contains($statut)) {
            $this->statut[] = $statut;
            $statut->setPrestation($this);
        }

        return $this;
    }

    public function removeStatut(PrestationStatut $statut): self
    {
        if ($this->statut->removeElement($statut)) {
            // set the owning side to null (unless already changed)
            if ($statut->getPrestation() === $this) {
                $statut->setPrestation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addPrestation($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removePrestation($this);
        }

        return $this;
    }
}
