<?php
    namespace Application\Repository\Command;
    
    class CreateOxydeCommand
    {
        
        public function __construct(
            private string $formule,
            private string $libelle,
            private string $pm,
            private int $colonneUml,
            private int $ordre,
            private bool $flagEtat,
            private \DateTimeImmutable $creationAt = new \DateTimeImmutable(),
            private \DateTimeImmutable $modificationAt = new \DateTimeImmutable()
        ){
            $this->formule = $formule;
            $this->libelle = $libelle;
            $this->pm = $pm;
            $this->colonneUml = $colonneUml;
            $this->ordre = $ordre;
            $this->flagEtat = $flagEtat;
        }

        public function getFormule(): ?string
        {
            return $this->formule;
        }

        public function setFormule(string $formule): self
        {
            $this->formule = $formule;

            return $this;
        }

        public function getLibelle(): ?string
        {
            return $this->libelle;
        }

        public function setLibelle(string $libelle): self
        {
            $this->libelle = $libelle;

            return $this;
        }

        public function getPm(): ?string
        {
            return $this->pm;
        }

        public function setPm(string $pm): self
        {
            $this->pm = $pm;

            return $this;
        }

        public function getColonneUml(): ?int
        {
            return $this->colonneUml;
        }

        public function setColonneUml(int $colonneUml): self
        {
            $this->colonneUml = $colonneUml;

            return $this;
        }
        
        public function getOrdre(): ?int
        {
            return $this->ordre;
        }

        public function setOrdre(int $ordre): self
        {
            $this->ordre = $ordre;

            return $this;
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
    }