<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DemandeRepository::class)
 */
class Demande
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
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="demandes")
     */
    private $entreprise;

    /**
     * @ORM\ManyToOne(targetEntity=Prestation::class, inversedBy="demandes")
     */
    private $prestation;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="demande")
     */
    private $messages;

    /**
     * @ORM\OneToMany(targetEntity=AttachementDemande::class, mappedBy="demande")
     */
    private $attachementDemandes;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->attachementDemandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

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

    public function getPrestation(): ?Prestation
    {
        return $this->prestation;
    }

    public function setPrestation(?Prestation $prestation): self
    {
        $this->prestation = $prestation;

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
            $message->setDemande($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getDemande() === $this) {
                $message->setDemande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AttachementDemande[]
     */
    public function getAttachementDemandes(): Collection
    {
        return $this->attachementDemandes;
    }

    public function addAttachementDemande(AttachementDemande $attachementDemande): self
    {
        if (!$this->attachementDemandes->contains($attachementDemande)) {
            $this->attachementDemandes[] = $attachementDemande;
            $attachementDemande->setDemande($this);
        }

        return $this;
    }

    public function removeAttachementDemande(AttachementDemande $attachementDemande): self
    {
        if ($this->attachementDemandes->removeElement($attachementDemande)) {
            // set the owning side to null (unless already changed)
            if ($attachementDemande->getDemande() === $this) {
                $attachementDemande->setDemande(null);
            }
        }

        return $this;
    }
}
