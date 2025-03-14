<?php namespace Application\RechercheEmail\DTO;

use Domain\Common\Object\Oxyde;

use Application\RechercheEmail\DTO\RechEmailOxDTO;

class RechEmailOxDTOMapper{
    public static function toDTO(Oxyde $oxyde) {
        $dto = new RechEmailOxDTO();
        $dto->setId($oxyde->getId())
            ->setNom($oxyde->getNom())
            ->setFormule($oxyde->getFormule())
            ->setType($oxyde->getType())
            ->setOrdre($oxyde->getOrdre())
            ->setFlagEtat($oxyde->getFlagEtat());
        return $oxyde;
    }
    public static function fromDTO(RechEmailOxDTO $dto):Oxyde {
        $oxyde = new Oxyde();
        $oxyde->setId($dto->getId())
            ->setNom($dto->getNom())
            ->setOrdre($dto->getOrdre())
            ->setFormule($dto->getFormule())
            ->setType($dto->getType())
            ->setFlagEtat($dto->getFlagEtat());
        return $oxyde;
    }
}

?>