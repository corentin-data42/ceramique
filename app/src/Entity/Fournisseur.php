<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
#[UniqueEntity('nom')]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $nom = null;

    #[ORM\Column]
    #[Assert\Type('bool')]
     private ?bool $flagEtat = null;

    /**
     * @var Collection<int, MatierePremiere>
     */
    #[ORM\OneToMany(targetEntity: MatierePremiere::class, mappedBy: 'fournisseur', cascade: ['persist'])]
    private Collection $matierePremieres;

    #[ORM\Column]
    private ?\DateTimeImmutable $creationAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $modificationAt = null;

    public function __construct()
    {
        $this->matierePremieres = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id= $id;
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

    public function isFlagEtat(): ?bool
    {
        return $this->flagEtat;
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

    /**
     * @return Collection<int, MatierePremiere>
     */
    public function getMatierePremieres(): Collection
    {
        return $this->matierePremieres;
    }

    public function addMatierePremiere(MatierePremiere $matierePremiere): static
    {
        if (!$this->matierePremieres->contains($matierePremiere)) {
            $this->matierePremieres->add($matierePremiere);
            $matierePremiere->setFournisseur($this);
        }

        return $this;
    }

    public function removeMatierePremiere(MatierePremiere $matierePremiere): static
    {
        if ($this->matierePremieres->removeElement($matierePremiere)) {
            // set the owning side to null (unless already changed)
            if ($matierePremiere->getFournisseur() === $this) {
                $matierePremiere->setFournisseur(null);
            }
        }

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

}
