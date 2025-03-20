<?php

namespace App\Entity;

use App\Repository\MatierePremiereOxydeQuantiteRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatierePremiereOxydeQuantiteRepository::class)]
#[ORM\Table(name: 'tl_matiere_premiere_oxyde')]
#[UniqueEntity(
    fields: ['matierePremiere', 'oxyde'],
    message: 'La matiere premiere possedent deja cette oxyde',
    errorPath: 'oxyde',
)]
class MatierePremiereOxydeQuantite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\Positive]
    private ?float $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'quantite')]
    #[ORM\JoinColumn(nullable: false)]
    ##[Assert\Valid()]
    private ?MatierePremiere $matierePremiere = null;

    #[ORM\ManyToOne(inversedBy: 'quantite')]
    #[ORM\JoinColumn(nullable: false)]
    ##[Assert\Valid()]
    private ?Oxyde $oxyde = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id): static
    {
        $this->id=$id;
        return $this;
    }

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getMatierePremiere(): ?MatierePremiere
    {
        return $this->matierePremiere;
    }

    public function setMatierePremiere(?MatierePremiere $matierePremiere): static
    {
        $this->matierePremiere = $matierePremiere;

        return $this;
    }

    public function getOxyde(): ?Oxyde
    {
        return $this->oxyde;
    }

    public function setOxyde(?Oxyde $oxyde): static
    {
        $this->oxyde = $oxyde;

        return $this;
    }
}
