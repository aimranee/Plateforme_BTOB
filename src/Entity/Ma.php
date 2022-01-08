<?php

namespace App\Entity;

use App\Repository\MaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaRepository::class)
 */
class Ma
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
    private $rc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ice;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $matriculation;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $capital;

    /**
     * @ORM\ManyToOne(targetEntity=Nationalite::class, inversedBy="mas")
     */
    private $nationalite;

    /**
     * @ORM\OneToOne(targetEntity=EtatSynthese::class, mappedBy="ma", cascade={"persist", "remove"})
     */
    private $etatSynthese;

    /**
     * @ORM\OneToMany(targetEntity=StatutMa::class, mappedBy="ma")
     */
    private $statutMas;

    /**
     * @ORM\ManyToMany(targetEntity=Activite::class, mappedBy="ma")
     */
    private $activites;

    /**
     * @ORM\ManyToOne(targetEntity=FormeLegaleMa::class, inversedBy="ma")
     */
    private $formeLegaleMa;

    /**
     * @ORM\OneToMany(targetEntity=FicheFinanciere::class, mappedBy="ma")
     */
    private $ficheFinanciere;

    /**
     * @ORM\ManyToMany(targetEntity=Categorie::class, inversedBy="mas")
     */
    private $Categorie;

    public function __construct()
    {
        $this->statutMas = new ArrayCollection();
        $this->activites = new ArrayCollection();
        $this->ficheFinanciere = new ArrayCollection();
        $this->Categorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRc(): ?string
    {
        return $this->rc;
    }

    public function setRc(?string $rc): self
    {
        $this->rc = $rc;

        return $this;
    }

    public function getIce(): ?string
    {
        return $this->ice;
    }

    public function setIce(?string $ice): self
    {
        $this->ice = $ice;

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

    public function getEtatSynthese(): ?EtatSynthese
    {
        return $this->etatSynthese;
    }

    public function setEtatSynthese(?EtatSynthese $etatSynthese): self
    {
        // unset the owning side of the relation if necessary
        if ($etatSynthese === null && $this->etatSynthese !== null) {
            $this->etatSynthese->setMa(null);
        }

        // set the owning side of the relation if necessary
        if ($etatSynthese !== null && $etatSynthese->getMa() !== $this) {
            $etatSynthese->setMa($this);
        }

        $this->etatSynthese = $etatSynthese;

        return $this;
    }

    /**
     * @return Collection|StatutMa[]
     */
    public function getStatutMas(): Collection
    {
        return $this->statutMas;
    }

    public function addStatutMa(StatutMa $statutMa): self
    {
        if (!$this->statutMas->contains($statutMa)) {
            $this->statutMas[] = $statutMa;
            $statutMa->setMa($this);
        }

        return $this;
    }

    public function removeStatutMa(StatutMa $statutMa): self
    {
        if ($this->statutMas->removeElement($statutMa)) {
            // set the owning side to null (unless already changed)
            if ($statutMa->getMa() === $this) {
                $statutMa->setMa(null);
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
            $activite->addMa($this);
        }

        return $this;
    }

    public function removeActivite(Activite $activite): self
    {
        if ($this->activites->removeElement($activite)) {
            $activite->removeMa($this);
        }

        return $this;
    }

    public function getFormeLegaleMa(): ?FormeLegaleMa
    {
        return $this->formeLegaleMa;
    }

    public function setFormeLegaleMa(?FormeLegaleMa $formeLegaleMa): self
    {
        $this->formeLegaleMa = $formeLegaleMa;

        return $this;
    }

    /**
     * @return Collection|FicheFinanciere[]
     */
    public function getFicheFinanciere(): Collection
    {
        return $this->ficheFinanciere;
    }

    public function addFicheFinanciere(FicheFinanciere $ficheFinanciere): self
    {
        if (!$this->ficheFinanciere->contains($ficheFinanciere)) {
            $this->ficheFinanciere[] = $ficheFinanciere;
            $ficheFinanciere->setMa($this);
        }

        return $this;
    }

    public function removeFicheFinanciere(FicheFinanciere $ficheFinanciere): self
    {
        if ($this->ficheFinanciere->removeElement($ficheFinanciere)) {
            // set the owning side to null (unless already changed)
            if ($ficheFinanciere->getMa() === $this) {
                $ficheFinanciere->setMa(null);
            }
        }

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
