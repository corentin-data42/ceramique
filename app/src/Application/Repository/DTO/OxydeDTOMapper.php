<?php namespace Application\Repository\DTO;

use Domain\Common\Object\Oxyde;

use Application\Repository\DTO\OxydeDTO;

class OxydeDTOMapper{
    public static function toDTO(Oxyde $oxyde) {
        $dto = new OxydeDTO();
        $dto->setId($oxyde->getId());
        $dto->setNom($oxyde->getNom());
        $dto->setFormule($oxyde->getFormule());
        $dto->setOrdre($oxyde->getOrdre());
        $dto->setActif($oxyde->isActif());
        return $dto;
    }
    public static function fromDTO(OxydeDTO $dto):Oxyde {
        $oxyde = new Oxyde();
        $oxyde->setId($dto->getId());
        $oxyde->setNom($dto->getNom());
        $oxyde->setFormule($dto->getFormule());
        $oxyde->setOrdre($dto->getOrdre());
        $oxyde->setActif($dto->getActif());
        return $oxyde;
    }
}

?>