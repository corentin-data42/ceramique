<?php
namespace App\DTO\Mapper;

use App\Entity\DoctrineOxyde;
use Application\Repository\DTO\OxydeDTO;

class OxydeDTOMapper{
    public static function fromDTO(OxydeDTO $dto):DoctrineOxyde {
        $oxyde = new DoctrineOxyde();
        $oxyde->setId($dto->getId());
        $oxyde->setNom($dto->getNom());
        $oxyde->setFormule($dto->getFormule());
        $oxyde->setOrdre($dto->getOrdre());
        $oxyde->setActif($dto->getActif());
        return $oxyde;
    }
}

?>