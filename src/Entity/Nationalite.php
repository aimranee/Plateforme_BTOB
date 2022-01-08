<?php

namespace App\Entity;

use App\Repository\NationaliteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NationaliteRepository::class)
 */
class Nationalite
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
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Entreprise::class, mappedBy="nationalite")
     */
    private $entreprise;

    /**
     * @ORM\OneToMany(targetEntity=Fr::class, mappedBy="nationalite")
     */
    private $frs;

    /**
     * @ORM\OneToMany(targetEntity=Ma::class, mappedBy="nationalite")
     */
    private $mas;

    public function __construct()
    {
        $this->entreprise = new ArrayCollection();
        $this->frs = new ArrayCollection();
        $this->mas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Entreprise[]
     */
    public function getEntreprise(): Collection
    {
        return $this->entreprise;
    }

    public function addEntreprise(Entreprise $entreprise): self
    {
        if (!$this->entreprise->contains($entreprise)) {
            $this->entreprise[] = $entreprise;
            $entreprise->setNationalite($this);
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): self
    {
        if ($this->entreprise->removeElement($entreprise)) {
            // set the owning side to null (unless already changed)
            if ($entreprise->getNationalite() === $this) {
                $entreprise->setNationalite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Fr[]
     */
    public function getFrs(): Collection
    {
        return $this->frs;
    }

    public function addFr(Fr $fr): self
    {
        if (!$this->frs->contains($fr)) {
            $this->frs[] = $fr;
            $fr->setNationalite($this);
        }

        return $this;
    }

    public function removeFr(Fr $fr): self
    {
        if ($this->frs->removeElement($fr)) {
            // set the owning side to null (unless already changed)
            if ($fr->getNationalite() === $this) {
                $fr->setNationalite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ma[]
     */
    public function getMas(): Collection
    {
        return $this->mas;
    }

    public function addMa(Ma $ma): self
    {
        if (!$this->mas->contains($ma)) {
            $this->mas[] = $ma;
            $ma->setNationalite($this);
        }

        return $this;
    }

    public function removeMa(Ma $ma): self
    {
        if ($this->mas->removeElement($ma)) {
            // set the owning side to null (unless already changed)
            if ($ma->getNationalite() === $this) {
                $ma->setNationalite(null);
            }
        }

        return $this;
    }
}
