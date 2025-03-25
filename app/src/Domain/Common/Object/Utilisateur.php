<?php declare(strict_types=1);

namespace Domain\Common\Object;

use Domain\Common\Object\Collection;

class Utilisateur{
    protected ?int $id = null;
    protected ?string $nom = null;
    protected ?string $email = null;
    protected ?string $password = null;
    protected ?bool $flagEtat = null;
    protected ?Collection $roles = null;
    protected ?Collection $stockMatPre = null;
    protected ?Collection $recettes = null;

    
    public function __construct(
        ?string $nom = null,
        ?string $email = null,
        ?string $password = null,
        ?bool $flagEtat = null,
        ?int $id = null,
        ){
            $this->nom = $nom;
            $this->email = $email;
            $this->password = $password;
            $this->flagEtat = $flagEtat;
            $this->id = $id;
            $this->roles = new Collection();
            $this->stockMatPre = new Collection();
            $this->recettes = new Collection();
    }

    /**
     * Get the value of id
     */ 
    public function getId(): int|null
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom(): string|null
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail(): string|null
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword(): string|null
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of stockMatPre
     */ 
    public function getStockMatPre(): Collection
    {
        return $this->stockMatPre;
    }

    /**
     * Get the value of recettes
     */ 
    public function getRecettes(): Collection
    {
        return $this->recettes;
    }

    /**
     * Get the value of flagEtat
     */ 
    public function getFlagEtat(): bool|null
    {
        return $this->flagEtat;
    }

    /**
     * Set the value of flagEtat
     *
     * @return  self
     */ 
    public function setFlagEtat(bool $flagEtat): static
    {
        $this->flagEtat = $flagEtat;

        return $this;
    }

    /**
     * Get the value of roles
     */ 
    public function getRoles(): Collection
    {
        return $this->roles;
    }
}

?>