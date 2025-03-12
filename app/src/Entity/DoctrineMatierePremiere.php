<?php

namespace App\Entity;

use App\Repository\DoctrineMatierePremiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DoctrineMatierePremiereRepository::class)]
#[ORM\Table(name: 'matiere_premiere')]
class DoctrineMatierePremiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $formule = null;

    #[ORM\Column(nullable: true)]
    private ?float $pmAvantCuisson = null;

    #[ORM\Column(nullable: true)]
    private ?int $ordre = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $creationAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $modificationAt = null;

    /**
     * @var Collection<int, DoctrineMatierePremiereOxyde>
     */
    #[ORM\OneToMany(targetEntity: DoctrineMatierePremiereOxyde::class, mappedBy: 'matierePremiere', orphanRemoval: true, cascade: ['persist'])]
    public Collection $oxydes;

    public function __construct()
    {
        $this->oxydes = new ArrayCollection();
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

    public function getFormule(): ?string
    {
        return $this->formule;
    }

    public function setFormule(string $formule): static
    {
        $this->formule = $formule;

        return $this;
    }

    public function getPmAvantCuisson(): ?float
    {
        return $this->pmAvantCuisson;
    }

    public function setPmAvantCuisson(?float $pmAvantCuisson): static
    {
        $this->pmAvantCuisson = $pmAvantCuisson;

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

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

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
     * @return Collection<int, DoctrineMatierePremiereOxyde>
     */
    public function getOxydes(): Collection
    {
        return $this->oxydes;
    }

    public function addOxydes(DoctrineMatierePremiereOxyde $oxyde): static
    {
        if (!$this->oxydes->contains($oxyde)) {
            $this->oxydes->add($oxyde);
            //$oxyde->setMatierePremiere($this);
        }

        return $this;
    }

    public function removeOxydes(DoctrineMatierePremiereOxyde $oxyde): static
    {
        if ($this->oxydes->removeElement($oxyde)) {
            // set the owning side to null (unless already changed)
            // if ($oxyde->getMatierePremiere() === $this) {
            //     $oxyde->setMatierePremiere(null);
            // }
        }

        return $this;
    }
}
