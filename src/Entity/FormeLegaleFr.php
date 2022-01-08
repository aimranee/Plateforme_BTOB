<?php

namespace App\Entity;

use App\Repository\FormeLegaleFrRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormeLegaleFrRepository::class)
 */
class FormeLegaleFr
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
     * @ORM\OneToMany(targetEntity=Fr::class, mappedBy="formeLegaleFr")
     */
    private $fr;

    public function __construct()
    {
        $this->fr = new ArrayCollection();
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
            $fr->setFormeLegaleFr($this);
        }

        return $this;
    }

    public function removeFr(Fr $fr): self
    {
        if ($this->fr->removeElement($fr)) {
            // set the owning side to null (unless already changed)
            if ($fr->getFormeLegaleFr() === $this) {
                $fr->setFormeLegaleFr(null);
            }
        }

        return $this;
    }
}
