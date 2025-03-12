<?php

namespace App\Entity;

use App\Repository\DoctrineOxydeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use App\Validator as AcmeAssert;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DoctrineOxydeRepository::class)]
#[ORM\Table(name: 'oxyde')]
class DoctrineOxyde
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

   
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private ?string $nom = null;

    
    #[ORM\Column]
    #[Assert\NotBlank]
    private ?float $pm = null;

    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private ?string $formule = null;

    
    #[ORM\Column]
    #[Assert\Sequentially([
        new Assert\NotBlank,
        new Assert\Type('integer'),
        new AcmeAssert\DoctrineOxydeType(['message'=>'le type doit etre 1,2 ou 3','typeAuthorise'=> [1,2,3]])
    ])]
    private ?int $type = null;

    #[Assert\Type('integer')]
    #[ORM\Column(nullable: true)]
    private ?int $ordre = null;

    #[ORM\Column]
    private ?bool $actif = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $creationAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $modificationAt = null;

    /**
     * @var Collection<int, DoctrineMatierePremiereOxyde>
     */
    // #[ORM\OneToMany(targetEntity: DoctrineMatierePremiereOxyde::class, mappedBy: 'oxyde', orphanRemoval: true)]
    // private Collection $matiere;

    public function __construct()
    {
        //$this->oxydes = new ArrayCollection();
    }

    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
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
     * @return Collection<int, DoctrineMatierePremiereOxyde>
     */
    // public function getOxydes(): Collection
    // {
    //     return $this->oxydes;
    // }

    // public function addOxyde(DoctrineMatierePremiereOxyde $oxyde): static
    // {
    //     if (!$this->oxydes->contains($oxyde)) {
    //         $this->oxydes->add($oxyde);
    //         $oxyde->setOxyde($this);
    //     }

    //     return $this;
    // }

    // public function removeOxyde(DoctrineMatierePremiereOxyde $oxyde): static
    // {
    //     if ($this->oxydes->removeElement($oxyde)) {
    //         // set the owning side to null (unless already changed)
    //         if ($oxyde->getOxyde() === $this) {
    //             $oxyde->setOxyde(null);
    //         }
    //     }

    //     return $this;
    // }
}
