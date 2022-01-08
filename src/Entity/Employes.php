<?php

namespace App\Entity;

use App\Repository\EmployesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployesRepository::class)
 */
class Employes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bacPlus5;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bacPlus4;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bacPlus3;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bacPlus2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bacOuMoin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $total;

    /**
     * @ORM\OneToOne(targetEntity=Entreprise::class, inversedBy="employes", cascade={"persist", "remove"})
     */
    private $entreprise;

    /**
     * @ORM\Column(type="integer")
     */
    private $plusBacPlus5;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBacPlus5(): ?int
    {
        return $this->bacPlus5;
    }

    public function setBacPlus5(?int $bacPlus5): self
    {
        $this->bacPlus5 = $bacPlus5;

        return $this;
    }

    public function getBacPlus4(): ?int
    {
        return $this->bacPlus4;
    }

    public function setBacPlus4(?int $bacPlus4): self
    {
        $this->bacPlus4 = $bacPlus4;

        return $this;
    }

    public function getBacPlus3(): ?int
    {
        return $this->bacPlus3;
    }

    public function setBacPlus3(?int $bacPlus3): self
    {
        $this->bacPlus3 = $bacPlus3;

        return $this;
    }

    public function getBacPlus2(): ?int
    {
        return $this->bacPlus2;
    }

    public function setBacPlus2(?int $bacPlus2): self
    {
        $this->bacPlus2 = $bacPlus2;

        return $this;
    }

    public function getBacOuMoin(): ?int
    {
        return $this->bacOuMoin;
    }

    public function setBacOuMoin(?int $bacOuMoin): self
    {
        $this->bacOuMoin = $bacOuMoin;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(?int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getPlusBacPlus5(): ?int
    {
        return $this->plusBacPlus5;
    }

    public function setPlusBacPlus5(int $plusBacPlus5): self
    {
        $this->plusBacPlus5 = $plusBacPlus5;

        return $this;
    }
}
