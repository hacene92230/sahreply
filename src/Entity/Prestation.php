<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PrestationRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

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

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="prestation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=PrestationType::class, inversedBy="prestations", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=PrestationStatut::class, inversedBy="prestations", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $statut;

    /**
     * @ORM\OneToMany(targetEntity=prestataire::class, mappedBy="prestation")
     */
    private $prestataire;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $instruction;

    public function __construct()
    {
        $this->prestataire = new ArrayCollection();
        $this->createdAt = new \DateTime();
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

    public function getType(): ?PrestationType
    {
        return $this->type;
    }

    public function setType(?PrestationType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatut(): ?PrestationStatut
    {
        return $this->statut;
    }

    public function setStatut(?PrestationStatut $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection|prestataire[]
     */
    public function getPrestataire(): Collection
    {
        return $this->prestataire;
    }

    public function addPrestataire(prestataire $prestataire): self
    {
        if (!$this->prestataire->contains($prestataire)) {
            $this->prestataire[] = $prestataire;
            $prestataire->setPrestation($this);
        }

        return $this;
    }

    public function removePrestataire(prestataire $prestataire): self
    {
        if ($this->prestataire->removeElement($prestataire)) {
            // set the owning side to null (unless already changed)
            if ($prestataire->getPrestation() === $this) {
                $prestataire->setPrestation(null);
            }
        }

        return $this;
    }


    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getInstruction(): ?string
    {
        return $this->instruction;
    }

    public function setInstruction(?string $instruction): self
    {
        $this->instruction = $instruction;

        return $this;
    }
}
