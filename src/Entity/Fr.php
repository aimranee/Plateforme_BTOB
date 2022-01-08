<?php

namespace App\Entity;

use App\Repository\FrRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FrRepository::class)
 */
class Fr
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siret;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siren;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $matriculation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numTVA;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $capital;

    /**
     * @ORM\ManyToOne(targetEntity=Nationalite::class, inversedBy="frs")
     */
    private $nationalite;

    /**
     * @ORM\OneToMany(targetEntity=StatutFr::class, mappedBy="fr")
     */
    private $statutFrs;

    /**
     * @ORM\OneToMany(targetEntity=CompteSocials::class, mappedBy="fr")
     */
    private $compteSocials;

    /**
     * @ORM\ManyToMany(targetEntity=Activite::class, mappedBy="fr")
     */
    private $activites;

    /**
     * @ORM\ManyToOne(targetEntity=FormeLegaleFr::class, inversedBy="fr")
     */
    private $formeLegaleFr;

    /**
     * @ORM\ManyToMany(targetEntity=Categorie::class, inversedBy="frs")
     */
    private $Categorie;

    public function __construct()
    {
        $this->statutFrs = new ArrayCollection();
        $this->compteSocials = new ArrayCollection();
        $this->activites = new ArrayCollection();
        $this->Categorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(?string $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    public function getMatriculation(): ?string
    {
        return $this->matriculation;
    }

    public function setMatriculation(?string $matriculation): self
    {
        $this->matriculation = $matriculation;

        return $this;
    }

    public function getNumTVA(): ?string
    {
        return $this->numTVA;
    }

    public function setNumTVA(?string $numTVA): self
    {
        $this->numTVA = $numTVA;

        return $this;
    }

    public function getCapital(): ?float
    {
        return $this->capital;
    }

    public function setCapital(?float $capital): self
    {
        $this->capital = $capital;

        return $this;
    }

    public function getNationalite(): ?Nationalite
    {
        return $this->nationalite;
    }

    public function setNationalite(?Nationalite $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * @return Collection|StatutFr[]
     */
    public function getStatutFrs(): Collection
    {
        return $this->statutFrs;
    }

    public function addStatutFr(StatutFr $statutFr): self
    {
        if (!$this->statutFrs->contains($statutFr)) {
            $this->statutFrs[] = $statutFr;
            $statutFr->setFr($this);
        }

        return $this;
    }

    public function removeStatutFr(StatutFr $statutFr): self
    {
        if ($this->statutFrs->removeElement($statutFr)) {
            // set the owning side to null (unless already changed)
            if ($statutFr->getFr() === $this) {
                $statutFr->setFr(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CompteSocials[]
     */
    public function getCompteSocials(): Collection
    {
        return $this->compteSocials;
    }

    public function addCompteSocial(CompteSocials $compteSocial): self
    {
        if (!$this->compteSocials->contains($compteSocial)) {
            $this->compteSocials[] = $compteSocial;
            $compteSocial->setFr($this);
        }

        return $this;
    }

    public function removeCompteSocial(CompteSocials $compteSocial): self
    {
        if ($this->compteSocials->removeElement($compteSocial)) {
            // set the owning side to null (unless already changed)
            if ($compteSocial->getFr() === $this) {
                $compteSocial->setFr(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }

    public function addActivite(Activite $activite): self
    {
        if (!$this->activites->contains($activite)) {
            $this->activites[] = $activite;
            $activite->addFr($this);
        }

        return $this;
    }

    public function removeActivite(Activite $activite): self
    {
        if ($this->activites->removeElement($activite)) {
            $activite->removeFr($this);
        }

        return $this;
    }

    public function getFormeLegaleFr(): ?FormeLegaleFr
    {
        return $this->formeLegaleFr;
    }

    public function setFormeLegaleFr(?FormeLegaleFr $formeLegaleFr): self
    {
        $this->formeLegaleFr = $formeLegaleFr;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getCategorie(): Collection
    {
        return $this->Categorie;
    }

    public function addCategorie(Categorie $categorie): self
    {
        if (!$this->Categorie->contains($categorie)) {
            $this->Categorie[] = $categorie;
        }

        return $this;
    }

    public function removeCategorie(Categorie $categorie): self
    {
        $this->Categorie->removeElement($categorie);

        return $this;
    }

    
}
