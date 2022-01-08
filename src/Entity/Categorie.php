<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
     * @ORM\ManyToOne(targetEntity=Activite::class, inversedBy="categories")
     */
    private $activite;

    /**
     * @ORM\ManyToMany(targetEntity=Ma::class, mappedBy="Categorie")
     */
    private $mas;

    /**
     * @ORM\ManyToMany(targetEntity=Fr::class, mappedBy="Categorie")
     */
    private $frs;

    public function __construct()
    {
        $this->mas = new ArrayCollection();
        $this->frs = new ArrayCollection();
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

    public function getActivite(): ?Activite
    {
        return $this->activite;
    }

    public function setActivite(?Activite $activite): self
    {
        $this->activite = $activite;

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
            $ma->addCategorie($this);
        }

        return $this;
    }

    public function removeMa(Ma $ma): self
    {
        if ($this->mas->removeElement($ma)) {
            $ma->removeCategorie($this);
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
            $fr->addCategorie($this);
        }

        return $this;
    }

    public function removeFr(Fr $fr): self
    {
        if ($this->frs->removeElement($fr)) {
            $fr->removeCategorie($this);
        }

        return $this;
    }
}
