<?php namespace Application\Repository\DTO;

use Domain\Common\Object\Oxyde;

use Application\Repository\DTO\RepOxDTO;

class RepOxDTOMapper{
    public static function toDTO(Oxyde $oxyde) {
        
        $dto = new RepOxDTO();
        $dto->setId($oxyde->getId());
        $dto->setNom($oxyde->getNom());
        $dto->setFormule($oxyde->getFormule());
        $dto->setType($oxyde->getType());
        $dto->setOrdre($oxyde->getOrdre());
        $dto->setFlagEtat($oxyde->getFlagEtat());
        $dto->setQuantite($oxyde->getQuantite());
        return $dto;
    }
    public static function fromDTO(RepOxDTO $dto):Oxyde {

        $oxyde = new Oxyde();
        $oxyde->setId($dto->getId());
        $oxyde->setNom($dto->getNom());
        $oxyde->setFormule($dto->getFormule());
        $oxyde->setType($dto->getType());
        $oxyde->setOrdre($dto->getOrdre());
        $oxyde->setFlagEtat($dto->getFlagEtat());
        $oxyde->setQuantite($dto->getQuantite());
        return $oxyde;
    }
}

?>