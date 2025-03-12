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
}

?>