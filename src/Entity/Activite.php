<?php

namespace App\Entity;

use App\Repository\ActiviteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActiviteRepository::class)
 */
class Activite
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
     * @ORM\Column(type="string", length=255)
     */
    private $abreviation;

    /**
     * @ORM\ManyToMany(targetEntity=Ma::class, inversedBy="activites")
     */
    private $ma;

    /**
     * @ORM\ManyToMany(targetEntity=Fr::class, inversedBy="activites")
     */
    private $fr;

    /**
     * @ORM\OneToMany(targetEntity=Categorie::class, mappedBy="activite")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Prestation::class, mappedBy="activite")
     */
    private $prestations;

 

    

    public function __construct()
    {
        $this->ma = new ArrayCollection();
        $this->fr = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->prestations = new ArrayCollection();
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

    public function getAbreviation(): ?string
    {
        return $this->abreviation;
    }

    public function setAbreviation(string $abreviation): self
    {
        $this->abreviation = $abreviation;

        return $this;
    }

    /**
     * @return Collection|Ma[]
     */
    public function getMa(): Collection
    {
        return $this->ma;
    }

    public function addMa(Ma $ma): self
    {
        if (!$this->ma->contains($ma)) {
            $this->ma[] = $ma;
        }

        return $this;
    }

    public function removeMa(Ma $ma): self
    {
        $this->ma->removeElement($ma);

        return $this;
    }

    /**
     * @return Collection|Fr[]
     */
    public function getFr(): Collection
    {
        return $this->fr;
    }

    public function addFr(Fr $fr): self
    {
        if (!$this->fr->contains($fr)) {
            $this->fr[] = $fr;
        }

        return $this;
    }

    public function removeFr(Fr $fr): self
    {
        $this->fr->removeElement($fr);

        return $this;
    }
 
    /**
     * @return Collection|Categorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setActivite($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getActivite() === $this) {
                $category->setActivite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Prestation[]
     */
    public function getPrestations(): Collection
    {
        return $this->prestations;
    }

    public function addPrestation(Prestation $prestation): self
    {
        if (!$this->prestations->contains($prestation)) {
            $this->prestations[] = $prestation;
            $prestation->setActivite($this);
        }

        return $this;
    }

    public function removePrestation(Prestation $prestation): self
    {
        if ($this->prestations->removeElement($prestation)) {
            // set the owning side to null (unless already changed)
            if ($prestation->getActivite() === $this) {
                $prestation->setActivite(null);
            }
        }

        return $this;
    }
}
