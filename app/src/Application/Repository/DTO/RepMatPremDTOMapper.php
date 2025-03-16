<?php namespace Application\Repository\DTO;

use Domain\Common\Object\MatierePremiere;
use Domain\Common\Object\Collection;

use Application\Repository\DTO\RepOxDTOMapper;
use Application\Repository\DTO\RepMatPremDTO;

/**
 *  Todo chargement des oxydes dans toDTO(MatierePremiere)
 */

class RepMatPremDTOMapper{

    /**
     * @dto MatierePremiere
     * return RepMatPremDTO
     */
    public static function toDTO(MatierePremiere $matierePremiere):RepMatPremDTO {

        /*
            RepMatPremDTO
            private ?int $id = null;
            private ?string $nom = null;
            private ?string $nomCour = null;
            private ?float $pmAvantCuisson = null;
            private ?array $oxydes;
            private ?int $ordre = null;
            private bool $flagEtat = false;
            private ?string $avertissement = null;
        */
        $dto = new RepMatPremDTO();
        $dto->setId($matierePremiere->getId());
        $dto->setNom($matierePremiere->getNom());
        $dto->setNomCour($matierePremiere->getNomCour());
        $dto->setPmAvantCuisson($matierePremiere->getPmAvantCuisson());
        $dto->setOrdre($matierePremiere->getOrdre());
        $dto->setFlagEtat($matierePremiere->getFlagEtat());
        $dto->setAvertissement($matierePremiere->getAvertissement());
        return $dto;
    }

    /**
     * @dto RepMatPremDTO
     * return MatierePremiere
     */
    public static function fromDTO(RepMatPremDTO $dto):MatierePremiere {
        $matierePremiere = new MatierePremiere();
        $matierePremiere->setId($dto->getId());
        $matierePremiere->setNom($dto->getNom());
        $matierePremiere->setNomCour($dto->getNomCour());
        $matierePremiere->setPmAvantCuisson($dto->getPmAvantCuisson());
        $matierePremiere->setOrdre($dto->getOrdre());
        $matierePremiere->setFlagEtat($dto->getFlagEtat());
        $matierePremiere->setAvertissement($dto->getAvertissement());
        foreach($dto->getOxydes() as $oxydeDTO){
            $oxyde = RepOxDTOMapper::fromDTO($oxydeDTO);
            $matierePremiere->addOxyde($oxyde);
        }
        return $matierePremiere;
    }
}

?>