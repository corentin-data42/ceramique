<?php

namespace App\Entity;

use App\Repository\OxydeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OxydeRepository::class)]
#[ORM\Table(name: 'oxyde')]
class Oxyde
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?float $pm = null;

    #[ORM\Column(length: 255)]
    private ?string $formule = null;

    #[ORM\Column]
    private ?int $type = null;

    #[ORM\Column(nullable: true)]
    private ?int $ordre = null;

    #[ORM\Column]
    private ?bool $actif = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $creationAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $modificationAt = null;

    /**
     * @var Collection<int, MatierePremiereOxydeQuantite>
     */
    #[ORM\OneToMany(targetEntity: MatierePremiereOxydeQuantite::class, mappedBy: 'oxyde', orphanRemoval: true)]
    private Collection $quantite;

    public function __construct()
    {
        $this->quantite = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPm(): ?float
    {
        return $this->pm;
    }

    public function setPm(float $pm): static
    {
        $this->pm = $pm;

        return $this;
    }

    public function getFormule(): ?string
    {
        return $this->formule;
    }

    public function setFormule(string $formule): static
    {
        $this->formule = $formule;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(?int $ordre): static
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): static
    {
        $this->actif = $actif;

        return $this;
    }

    public function getCreationAt(): ?\DateTimeImmutable
    {
        return $this->creationAt;
    }

    public function setCreationAt(\DateTimeImmutable $creationAt): static
    {
        $this->creationAt = $creationAt;

        return $this;
    }

    public function getModificationAt(): ?\DateTimeImmutable
    {
        return $this->modificationAt;
    }

    public function setModificationAt(\DateTimeImmutable $modificationAt): static
    {
        $this->modificationAt = $modificationAt;

        return $this;
    }

    /**
     * @return Collection<int, MatierePremiereOxydeQuantite>
     */
    public function getQuantite(): Collection
    {
        return $this->quantite;
    }

    public function addQuantite(MatierePremiereOxydeQuantite $quantite): static
    {
        if (!$this->quantite->contains($quantite)) {
            $this->quantite->add($quantite);
            $quantite->setOxyde($this);
        }

        return $this;
    }

    public function removeQuantite(MatierePremiereOxydeQuantite $quantite): static
    {
        if ($this->quantite->removeElement($quantite)) {
            // set the owning side to null (unless already changed)
            if ($quantite->getOxyde() === $this) {
                $quantite->setOxyde(null);
            }
        }

        return $this;
    }
}
