<?php
namespace Domain\Common\Object;

class Fournisseur{
    protected ?int $id = null;
    protected ?string $nom =null;
    protected ?bool $flagEtat = null; 

    public function __construct()
    {
    }
    public function setId(int $id):static{
        $this->id =$id;
        return $this;
    }
    public function setNom(string $nom):static{
        $this->nom =$nom;
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
    public function getFlagEtat():bool{
        return $this->flagEtat;
    }
}

?>
