<?php

namespace App\Entity;

use App\Repository\FormeLegaleMaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormeLegaleMaRepository::class)
 */
class FormeLegaleMa
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
     * @ORM\OneToMany(targetEntity=Ma::class, mappedBy="formeLegaleMa")
     */
    private $ma;

    public function __construct()
    {
        $this->ma = new ArrayCollection();
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
            $ma->setFormeLegaleMa($this);
        }

        return $this;
    }

    public function removeMa(Ma $ma): self
    {
        if ($this->ma->removeElement($ma)) {
            // set the owning side to null (unless already changed)
            if ($ma->getFormeLegaleMa() === $this) {
                $ma->setFormeLegaleMa(null);
            }
        }

        return $this;
    }
}
