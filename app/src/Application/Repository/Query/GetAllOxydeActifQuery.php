<?php
    namespace Application\Repository\Query;

    class GetAllOxydeActifQuery{
        public const __ORDER_BY_TYPE = 'type';
        public function __construct(
            protected bool $actif = true,
            protected string $ordreBy = ''
            ) {}
        
        public function getActif(): bool
        {
            return $this->actif;
        }

        public function setActif(bool $actif): self
        {
            $this->actif=$actif;
            return $this;
        }
        public function getOrdreBy(): string
        {
            return $this->ordreBy;
        }

        public function setOrdreBy(string $ordreBy): self
        {
            $this->ordreBy=$ordreBy;
            return $this;
        }
    }