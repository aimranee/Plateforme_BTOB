<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrestationRepository::class)
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $icon;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="prestations")
     */
    private $entreprise;

    /**
     * @ORM\OneToMany(targetEntity=Demande::class, mappedBy="prestation")
     */
    private $demandes;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="prestation")
     */
    private $messages;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixMin;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixMax;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

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
     * @ORM\OneToMany(targetEntity=AttachementPrestation::class, mappedBy="prestation")
     */
    private $attachementPrestations;

    /**
     * @ORM\Column(type="integer")
     */
    private $plusBacPlus5;
    /**
     * @ORM\ManyToOne(targetEntity=Activite::class, inversedBy="prestations")
     */
    private $activite;

    public function __construct()
    {
        $this->demandes = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->attachementPrestations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
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

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

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

    /**
     * @return Collection|Demande[]
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demande $demande): self
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes[] = $demande;
            $demande->setPrestation($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): self
    {
        if ($this->demandes->removeElement($demande)) {
            // set the owning side to null (unless already changed)
            if ($demande->getPrestation() === $this) {
                $demande->setPrestation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setPrestation($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getPrestation() === $this) {
                $message->setPrestation(null);
            }
        }

        return $this;
    }

    public function getPrixMin(): ?float
    {
        return $this->prixMin;
    }

    public function setPrixMin(?float $prixMin): self
    {
        $this->prixMin = $prixMin;

        return $this;
    }

    public function getPrixMax(): ?float
    {
        return $this->prixMax;
    }

    public function setPrixMax(?float $prixMax): self
    {
        $this->prixMax = $prixMax;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
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

    /**
     * @return Collection|AttachementPrestation[]
     */
    public function getAttachementPrestations(): Collection
    {
        return $this->attachementPrestations;
    }

    public function addAttachementPrestation(AttachementPrestation $attachementPrestation): self
    {
        if (!$this->attachementPrestations->contains($attachementPrestation)) {
            $this->attachementPrestations[] = $attachementPrestation;
            $attachementPrestation->setPrestation($this);
        }

        return $this;
    }

    public function removeAttachementPrestation(AttachementPrestation $attachementPrestation): self
    {
        if ($this->attachementPrestations->removeElement($attachementPrestation)) {
            // set the owning side to null (unless already changed)
            if ($attachementPrestation->getPrestation() === $this) {
                $attachementPrestation->setPrestation(null);
            }
        }

        return $this;
    }


    public function getPlusBacPlus5(): ?int
    {
        return $this->plusBacPlus5;
    }

    public function setPlusBacPlus5(int $plusBacPlus5): self
    {
        $this->plusBacPlus5 = $plusBacPlus5;
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

}
