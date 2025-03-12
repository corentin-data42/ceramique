<?php

namespace App\Entity;

use App\Repository\MatierePremiereOxydeQuantiteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatierePremiereOxydeQuantiteRepository::class)]
#[ORM\Table(name: 'tl_matiere_premiere_oxyde')]
class MatierePremiereOxydeQuantite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'quantite')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MatierePremiere $matierePremiere = null;

    #[ORM\ManyToOne(inversedBy: 'quantite')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Oxyde $oxyde = null;

    public function getId(): ?int
    {
        return $this->id;
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
