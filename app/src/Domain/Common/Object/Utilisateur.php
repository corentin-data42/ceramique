<?php declare(strict_types=1);

namespace Domain\Common\Object;

use Domain\Common\Object\Collection;

class Utilisateur{
    protected ?int $id = null;
    protected ?string $nom = null;
    protected ?string $email = null;
    protected ?string $password = null;
    protected ?Collection $stockMatPre = null;
    protected ?Collection $recettes = null;

    


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
    public function setId(int $id)
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
    public function setNom(string $nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of stockMatPre
     */ 
    public function getStockMatPre()
    {
        return $this->stockMatPre;
    }

    /**
     * Get the value of recettes
     */ 
    public function getRecettes()
    {
        return $this->recettes;
    }
}

?>