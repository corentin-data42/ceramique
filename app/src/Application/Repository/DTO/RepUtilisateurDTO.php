<?php
namespace Application\Repository\DTO;

class RepUtilisateurDTO{
    private ?int $id = null;
    private ?string $nom = null;
    private ?string $email = null;
    private ?string $password = null;
    private ?array $roles = [];
    private ?bool $flagEtat = null;
    private ?\DateTimeImmutable $creationAt = null;
    private ?\DateTimeImmutable $modificationAt = null;
    public function setId(?int $id):static{
        $this->id = $id;
        return $this;
    }
    public function setNom(?string $nom):static{
        $this->nom = $nom;
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

    public function getFlagEtat():?bool{
        return $this->flagEtat;
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
     * Get the value of roles
     */ 
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set the value of roles
     *
     * @return  self
     */ 
    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get the value of creationAt
     */ 
    public function getCreationAt(): \DateTimeImmutable|null
    {
        return $this->creationAt;
    }

    /**
     * Set the value of creationAt
     *
     * @return  self
     */ 
    public function setCreationAt(\DateTimeImmutable $creationAt): static
    {
        $this->creationAt = $creationAt;

        return $this;
    }

    /**
     * Get the value of modificationAt
     */ 
    public function getModificationAt(): \DateTimeImmutable|null
    {
        return $this->modificationAt;
    }

    /**
     * Set the value of modificationAt
     *
     * @return  self
     */ 
    public function setModificationAt(\DateTimeImmutable $modificationAt): static
    {
        $this->modificationAt = $modificationAt;

        return $this;
    }
}
?>