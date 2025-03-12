<?php
    namespace Application\RechercheEmail\Query;

    class GetAllOxydeActifQuery{
        public function __construct(protected bool $actif = true) {}
        
        public function isActif(): bool
        {
            return $this->actif;
        }

        public function setActif(bool $actif): self
        {
            $this->actif=$actif;
            return $this;
        }
    }