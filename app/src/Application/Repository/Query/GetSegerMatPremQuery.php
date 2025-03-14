<?php
    namespace Application\Repository\Query;

    class GetSegerMatPremQuery{
        public function __construct(
            protected array $id,
            protected ?bool $activeOnly = true
        ) {}
        
        public function getId(): array
        {
            return $this->id;
        }

        public function setId(array $id): self
        {
            $this->id=$id;
            return $this;
        }

        public function getActiveOnly(): bool
        {
            return $this->activeOnly;
        }

        public function setActiveOnly(bool $activeOnly): self
        {
            $this->activeOnly=$activeOnly;
            return $this;
        }
    }