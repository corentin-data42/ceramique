<?php
namespace App\DTO\Mapper;

use App\Entity\MatierePremiere;
use Application\Repository\DTO\RepMatPremDTO;

class MatPremDTOMapper{
    public static function fromDTO(RepMatPremDTO $dto):MatierePremiere {
        $oxyde = new MatierePremiere();
        $oxyde->setId($dto->getId())
            ->setNom($dto->getNom())
            ->setFormule($dto->getFormule())
            ->setOrdre($dto->getOrdre())
            ->setType($dto->getType())
            ->setFlagEtat($dto->getFlagEtat());
        return $oxyde;
    }
    public static function toDTO(MatierePremiere $oxyde):RepMatPremDTO {
        $dto = new RepMatPremDTO();
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