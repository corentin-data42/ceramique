<?php namespace Application\Repository\DTO;

use Domain\Common\Object\MatierePremiere;

use Application\Repository\DTO\RepOxDTOMapper;
use Application\Repository\DTO\RepMatPremDTO;

class RepMatPremDTOMapper{
    public static function toDTO(MatierePremiere $matierePremiere) {

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
            $matierePremiere->addOxyde(RepOxDTOMapper::fromDTO($oxydeDTO));
        }
        //dump($dto->getOxydes());
        return $matierePremiere;
    }
}

?>