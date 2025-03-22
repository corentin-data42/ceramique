<?php declare(strict_types= 1);

namespace Application\GestionUtilisateur\Command;

class AjouteUtilisateurCommand{

    private string $nom;
    private string $password;
    private string $email;
    private array $roles;
    private bool $flagEtat;
    public function __construct(){
        $this->roles = [];
    }
    /**
     * Get the value of nom
     */ 
    public function getNom(): string
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
     * Get the value of password
     */ 
    public function getPassword(): string
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
     * Get the value of email
     */ 
    public function getEmail(): string
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
     * Get the value of flagEtat
     */ 
    public function getFlagEtat(): bool
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
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * Set the value of roles
     *
     * @return  self
     */ 
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }
}

?>