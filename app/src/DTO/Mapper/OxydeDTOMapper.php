<?php
namespace App\DTO\Mapper;

use App\Entity\Oxyde;
use Application\Repository\DTO\RepOxDTO;

class OxydeDTOMapper{
    public static function fromDTO(RepOxDTO $dto):Oxyde {
        $oxyde = new Oxyde();
        $oxyde->setId($dto->getId())
            ->setNom($dto->getNom())
            ->setFormule($dto->getFormule())
            ->setOrdre($dto->getOrdre())
            ->setType($dto->getType())
            ->setFlagEtat($dto->getFlagEtat());
        return $oxyde;
    }
    public static function toDTO(Oxyde $oxyde):RepOxDTO {

        $dto = new RepOxDTO();
        $dto->setId($oxyde->getId())
            ->setNom($oxyde->getNom())
            ->setFormule($oxyde->getFormule())
            ->setType($oxyde->getType())
            ->setOrdre($oxyde->getOrdre())
            ->setFlagEtat($oxyde->getFlagEtat());

        return $dto;
    }
}

?>