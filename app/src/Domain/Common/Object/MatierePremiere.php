<?php
namespace Domain\Common\Object;

use Domain\Common\Object\Collection;
use Domain\Common\Object\OxydeQuantite;

class MatierePremiere{
    protected ?int $id = null;
    protected ?string $nom =null;
    protected ?string $formule = null;
    protected ?float $pmAvantCuisson = null;
    protected ?int $ordre = null;
    protected ?bool $active = null; 
    protected ?Collection $oxydes = null;

    public function __construct()
    {
        $this->oxydes = new Collection();
    }
    public function setId(int $id):static{
        $this->id =$id;
        return $this;
    }
    public function setNom(string $nom):static{
        $this->nom =$nom;
        return $this;
    }
    public function setFormule(string $formule):static{
        $this->formule =$formule;
        return $this;
    }
    public function setPmAvantCuisson(float $pmAvantCuisson):static{
        $this->pmAvantCuisson =$pmAvantCuisson;
        return $this;
    }
    public function setOrdre(int $ordre):static{
        $this->ordre =$ordre;
        return $this;
    }
    public function setActive(bool $active):static{
        $this->active= $active;
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
    public function getPmAvantCuisson():float{
        return $this->pmAvantCuisson;
    }
    public function getOrdre():int{
        return $this->ordre;
    }
    public function isActive():bool{
        return $this->active;
    }
    public function getOxydes():Collection{
        return $this->oxydes;
    }

    public function addOxyde(OxydeQuantite $oxyde) : static{
        if(!$this->oxydes->contains($oxyde)){
            $this->oxydes->add($oxyde);
        }
        return $this;
    }
    public function removeOxyde(OxydeQuantite $oxyde):static{
        if($this->oxydes->contains($oxyde)){
            $this->oxydes->remove($oxyde);
        }
        return $this;
    }
}

?>