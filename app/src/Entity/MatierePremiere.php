<?php

namespace App\Entity;

use App\Repository\MatierePremiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: MatierePremiereRepository::class)]
#[ORM\Table(name: 'matiere_premiere')]

class MatierePremiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Positive]
    private ?float $pmAvantCuisson = null;

    #[ORM\Column(nullable: true)]
    private ?int $ordre = null;

    #[ORM\Column()]
    private bool $flagEtat = false;

    #[ORM\Column]
    private ?\DateTimeImmutable $creationAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $modificationAt = null;

    /**
     * @var Collection<int, MatierePremiereOxydeQuantite>
     */
    #[ORM\OneToMany(targetEntity: MatierePremiereOxydeQuantite::class, mappedBy: 'matierePremiere', orphanRemoval: true, cascade: ['persist'])]
    private Collection $quantite;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avertissement = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private ?string $nomCour = null;

    public function __construct()
    {
        $this->quantite = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {   
        $this->$id = $id;
        return $this;
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

    public function getFlagEtat(): ?bool
    {
        return $this->flagEtat;
    }

    public function setFlagEtat(bool $flagEtat): static
    {
        $this->flagEtat = $flagEtat;

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
            $quantite->setMatierePremiere($this);
        }

        return $this;
    }

    public function removeQuantite(MatierePremiereOxydeQuantite $quantite): static
    {
        if ($this->quantite->removeElement($quantite)) {
            // set the owning side to null (unless already changed)
            if ($quantite->getMatierePremiere() === $this) {
                $quantite->setMatierePremiere(null);
            }
        }

        return $this;
    }

    public function getAvertissement(): ?string
    {
        return $this->avertissement;
    }

    public function setAvertissement(?string $avertissement): static
    {
        $this->avertissement = $avertissement;

        return $this;
    }

    public function getNomCour(): ?string
    {
        return $this->nomCour;
    }

    public function setNomCour(string $nomCour): static
    {
        $this->nomCour = $nomCour;

        return $this;
    }
}
