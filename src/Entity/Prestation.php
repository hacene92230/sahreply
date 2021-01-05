<?php

namespace App\Entity;

use App\Entity\PrestationStatut;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PrestationRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=PrestationRepository::class)
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $achieveAt;

    /**
     /**
     * @ORM\PrePersist
     *
     * @return void
     */
    public function initialize()
    {
        if (empty($this->createdAt)) {
            $this->createdAt = new \DateTime();
        }
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

    public function getAchieveAt(): ?\DateTimeInterface
    {
        return $this->achieveAt;
    }

    public function setAchieveAt(?\DateTimeInterface $achieveAt): self
    {
        $this->achieveAt = $achieveAt;

        return $this;
    }
}
