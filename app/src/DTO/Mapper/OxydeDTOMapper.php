<?php
namespace App\DTO\Mapper;

use App\Entity\Oxyde;
use Application\Repository\DTO\OxydeDTO;

class OxydeDTOMapper{
    public static function fromDTO(OxydeDTO $dto):Oxyde {
        $oxyde = new Oxyde();
        $oxyde->setId($dto->getId())
            ->setNom($dto->getNom())
            ->setFormule($dto->getFormule())
            ->setOrdre($dto->getOrdre())
            ->setActif($dto->getActif());
        return $oxyde;
    }
    public static function toDTO(Oxyde $oxyde):OxydeDTO {
        $dto = new OxydeDTO();
        $dto->setId($oxyde->getId())
            ->setNom($oxyde->getNom())
            ->setFormule($oxyde->getFormule())
            ->setOrdre($oxyde->getOrdre())
            ->setActif($oxyde->getActif());
        return $dto;
    }
}

?>