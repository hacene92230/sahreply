<?php

namespace App\Entity;

use App\Repository\PrestatairesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrestatairesRepository::class)
 */
class Prestataires
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
    private $acceptAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="prestataires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Prestation::class, inversedBy="prestataire")
     * @ORM\JoinColumn(nullable=false)
     */
    private $prestation;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAcceptAt(): ?\DateTimeInterface
    {
        return $this->acceptAt;
    }

    public function setAcceptAt(\DateTimeInterface $acceptAt): self
    {
        $this->acceptAt = $acceptAt;

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

    public function getPrestation(): ?Prestation
    {
        return $this->prestation;
    }

    public function setPrestation(?Prestation $prestation): self
    {
        $this->prestation = $prestation;

        return $this;
    }
}
