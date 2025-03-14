<?php
namespace Application\Repository\DTO;

class RepOxDTO{
    private ?int $id = null;
    private ?string $nom = null;
    private ?string $formule = null;
    private ?int $type = null;
    private ?int $ordre = 0;
    private ?bool $flagEtat = null;
    public function setId(?int $id):static{
        $this->id = $id;
        return $this;
    }
    public function setNom(?string $nom):static{
        $this->nom = $nom;
        return $this;
    }
    public function setFormule(?string $formule):static{
        $this->formule = $formule;
        return $this;
    }
    public function setType(?int $type):static{
        $this->type = $type;
        return $this;
    }
    public function setOrdre(?int $ordre):static{
        $this->ordre = $ordre;
        return $this;
    }
    public function setFlagEtat(?bool $flagEtat):static{
        $this->flagEtat = $flagEtat;
        return $this;
    }

    public function getId():?int{
        return $this->id;
    }
    public function getNom():?string{
        return $this->nom;
    }
    public function getFormule():?string{
        return $this->formule;
    }
    public function getType():?int{
        return $this->type;
    }
    public function getOrdre():?int{
        return $this->ordre;
    }
    public function getFlagEtat():?bool{
        return $this->flagEtat;
    }

}
?>