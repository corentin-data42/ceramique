<?php
    namespace Application\Repository\Query;

    class GetOxydeByIdQuery{
        public function __construct(
            protected array $id,
            protected ?bool $actifOnly = true
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

        public function getActifOnly(): bool
        {
            return $this->actifOnly;
        }

        public function setActifOnly(bool $actifOnly): self
        {
            $this->actifOnly=$actifOnly;
            return $this;
        }
    }