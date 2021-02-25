<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DemandeRepository::class)
 */
class Demande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="demande", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255000)
     */
    private $cv;

    /**
     * @ORM\Column(type="string", length=255000)
     */
    private $motivation;

    /**
     * @ORM\ManyToMany(targetEntity=PrestationType::class, inversedBy="demandes")
     */
    private $specialite;

    /**
     * @ORM\Column(type="boolean")
     */
    private $permis;

    /**
     * @ORM\Column(type="boolean")
     */
    private $voiture;

    /**
     * @ORM\Column(type="boolean")
     */
    private $GPS;

    public function __construct()
    {
        $this->specialite = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getMotivation(): ?string
    {
        return $this->motivation;
    }

    public function setMotivation(string $motivation): self
    {
        $this->motivation = $motivation;

        return $this;
    }

    /**
     * @return Collection|PrestationType[]
     */
    public function getSpecialite(): Collection
    {
        return $this->specialite;
    }

    public function addSpecialite(PrestationType $specialite): self
    {
        if (!$this->specialite->contains($specialite)) {
            $this->specialite[] = $specialite;
        }

        return $this;
    }

    public function removeSpecialite(PrestationType $specialite): self
    {
        $this->specialite->removeElement($specialite);

        return $this;
    }

    public function getPermis(): ?bool
    {
        return $this->permis;
    }

    public function setPermis(bool $permis): self
    {
        $this->permis = $permis;

        return $this;
    }

    public function getVoiture(): ?bool
    {
        return $this->voiture;
    }

    public function setVoiture(bool $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }

    public function getGPS(): ?bool
    {
        return $this->GPS;
    }

    public function setGPS(bool $GPS): self
    {
        $this->GPS = $GPS;

        return $this;
    }
}
