<?php
namespace Domain\Common\Object;

use Domain\Common\Object\Collection;
use Domain\Common\Object\Oxyde;

class MatierePremiere{
    protected ?int $id = null;
    protected ?string $nom =null;
    protected ?string $nomCour = null;
    protected ?string $avertissement = null;
    protected ?float $pmAvantCuisson = null;
    protected ?int $ordre = null;
    protected ?bool $flagEtat = null; 
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
    public function setNomCour(string $nomCour):static{
        $this->nomCour =$nomCour;
        return $this;
    }
    public function setAvertissement(string $avertissement):static{
        $this->avertissement =$avertissement;
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
    public function setFlagEtat(bool $flagEtat):static{
        $this->flagEtat= $flagEtat;
        return $this;
    }


    public function getId():int{
        return $this->id;
    }
    public function getNom():string{
        return $this->nom;
    }
    public function getNomCour():string{
        return $this->nomCour;
    }
    public function getAvertissement():string{
        return $this->avertissement;
    }
    public function getPmAvantCuisson():float{
        return $this->pmAvantCuisson;
    }
    public function getOrdre():int{
        return $this->ordre;
    }
    public function getFlagEtat():bool{
        return $this->flagEtat;
    }
    public function getOxydes():Collection{
        return $this->oxydes;
    }

    public function addOxyde(Oxyde $oxyde) : static{
        if(!$this->oxydes->contains($oxyde)){
            $this->oxydes->add($oxyde);
        }
        return $this;
    }
    public function removeOxyde(Oxyde $oxyde):static{
        if($this->oxydes->contains($oxyde)){
            $this->oxydes->remove($oxyde);
        }
        return $this;
    }
}

?>