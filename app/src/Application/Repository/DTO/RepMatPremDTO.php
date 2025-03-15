<?php
namespace Application\Repository\DTO;

class RepMatPremDTO{
    private ?int $id = null;
    private ?string $nom = null;
    private ?string $nomCour = null;
    private ?float $pmAvantCuisson = null;
    private ?array $oxydes;
    private ?int $ordre = null;
    private bool $flagEtat = false;
    private ?string $avertissement = null;




    /**
     * Get the value of id
     */ 
    public function getId():int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id):static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom():string
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom(string $nom):static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of nomCour
     */ 
    public function getNomCour():string
    {
        return $this->nomCour;
    }

    /**
     * Set the value of nomCour
     *
     * @return  self
     */ 
    public function setNomCour(string $nomCour):static
    {
        $this->nomCour = $nomCour;

        return $this;
    }

    /**
     * Get the value of pmAvantCuisson
     */ 
    public function getPmAvantCuisson():?float
    {
        return $this->pmAvantCuisson;
    }

    /**
     * Set the value of pmAvantCuisson
     *
     * @return  self
     */ 
    public function setPmAvantCuisson(?float $pmAvantCuisson):static
    {
        $this->pmAvantCuisson = $pmAvantCuisson;

        return $this;
    }

    /**
     * Get the value of oxydes
     */ 
    public function getOxydes():array
    {
        return $this->oxydes;
    }

    /**
     * Set the value of oxydes
     *
     * @return  self
     */ 
    public function setOxydes(array $oxydes):static
    {
        $this->oxydes = $oxydes;

        return $this;
    }

    /**
     * Get the value of ordre
     */ 
    public function getOrdre():?int
    {
        return $this->ordre;
    }

    /**
     * Set the value of ordre
     *
     * @return  self
     */ 
    public function setOrdre(?int $ordre):static
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get the value of flagEtat
     */ 
    public function getFlagEtat():bool
    {
        return $this->flagEtat;
    }

    /**
     * Set the value of flagEtat
     *
     * @return  self
     */ 
    public function setFlagEtat(bool $flagEtat):static
    {
        $this->flagEtat = $flagEtat;

        return $this;
    }

    /**
     * Get the value of avertissement
     */ 
    public function getAvertissement():?string
    {
        return $this->avertissement;
    }

    /**
     * Set the value of avertissement
     *
     * @return  self
     */ 
    public function setAvertissement(?string $avertissement) :static
    {
        $this->avertissement = $avertissement;

        return $this;
    }
}
?>