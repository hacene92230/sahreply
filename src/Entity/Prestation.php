<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
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
     * @ORM\OneToOne(targetEntity=PrestationStatut::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $statut;

    /**
     * @ORM\OneToOne(targetEntity=PrestationType::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

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

    public function getStatut(): ?PrestationStatut
    {
        return $this->statut;
    }

    public function setStatut(PrestationStatut $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getType(): ?PrestationType
    {
        return $this->type;
    }

    public function setType(PrestationType $type): self
    {
        $this->type = $type;

        return $this;
    }
}
