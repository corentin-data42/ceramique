<?php
    namespace Application\Repository\Command;
    
    class CreateUtilisateurCommand
    {
        
        public function __construct(
            private string $nom,
            private string $email,
            private string $password,
            private array $roles,
            private bool $flagEtat,
            private \DateTimeImmutable $creationAt = new \DateTimeImmutable(),
            private \DateTimeImmutable $modificationAt = new \DateTimeImmutable()
        ){
            $this->nom = $nom;
            $this->email = $email;
            $this->password = $password;
            $this->flagEtat = $flagEtat;
        }


        public function getFlagEtat(): ?bool
        {
            return $this->flagEtat;
        }

        public function setFlagEtat(bool $flagEtat): self
        {
            $this->flagEtat = $flagEtat;

            return $this;
        }

        public function getCreationAt(): ?\DateTimeImmutable
        {
            return $this->creationAt;
        }

        public function setCreationAt(\DateTimeImmutable $creationAt): self
        {
            $this->creationAt = $creationAt;

            return $this;
        }

        public function getModificationAt(): ?\DateTimeImmutable
        {
            return $this->modificationAt;
        }

        public function setModificationAt(\DateTimeImmutable $modificationAt): self
        {
            $this->modificationAt = $modificationAt;

            return $this;
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
            public function setNom(string $nom)
            {
                        $this->nom = $nom;

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