<?php declare(strict_types=1);
namespace Application\Repository\DTO;

class RepFournisseurDTO{
    private ?int $id =null;
    private ?string $nom = null;
    private ?bool $flagEtat = null;

    private ?array $matierePremiere = null;

    public function __construct(){
        $this->matierePremiere = [];
    }
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of flagEtat
     */ 
    public function getFlagEtat()
    {
        return $this->flagEtat;
    }

    /**
     * Set the value of flagEtat
     *
     * @return  self
     */ 
    public function setFlagEtat($flagEtat)
    {
        $this->flagEtat = $flagEtat;

        return $this;
    }
}

?>