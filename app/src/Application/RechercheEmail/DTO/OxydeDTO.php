<?php
namespace Application\RechercheEmail\DTO;

class OxydeDTO{
    private ?int $id = null;
    private ?string $nom = null;
    private ?string $formule = null;
    private ?int $type = null;
    private ?int $ordre = null;
    private ?bool $actif = null;
    public function setId(?int $id):static{
        return $this;
    }
    public function setNom(?string $nom):static{
        return $this;
    }
    public function setFormule(?string $formule):static{
        return $this;
    }
    public function setType(?int $type):static{
        return $this;
    }
    public function setOrdre(?int $ordre):static{
        return $this;
    }
    public function setActif(?bool $actif):static{
        return $this;
    }

    public function getId():int{
        return $this->id;
    }
    public function getNom():string{
        return $this->nom;
    }
    public function getFormule():string{
        return $this->formule;
    }
    public function getType():int{
        return $this->type;
    }
    public function getOrdre():int{
        return $this->ordre;
    }
    public function getActif():bool{
        return $this->actif;
    }

}
?>