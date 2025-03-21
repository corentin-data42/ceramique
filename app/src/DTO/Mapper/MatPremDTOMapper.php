<?php
namespace App\DTO\Mapper;

use App\Entity\MatierePremiere;


use Application\Repository\DTO\RepMatPremDTO;

use App\DTO\Mapper\OxydeDTOMapper;
use App\DTO\Mapper\FournisseurDTOMapper;



class MatPremDTOMapper{
    public static function fromDTO(RepMatPremDTO $dto):MatierePremiere {
        $matierePremiere = new MatierePremiere();
        $matierePremiere->setId($dto->getId())
            ->setNom($dto->getNom())
            ->setNomCour($dto->getNomCour())
            ->setPmAvantCuisson($dto->getPmAvantCuisson())
            ->setOrdre($dto->getOrdre())
            ->setAvertissement($dto->getAvertissement())
            ->setFlagEtat($dto->getFlagEtat());
            // ajouter traitement des oxydes
        if ($dto->getFournisseur()){
            $matierePremiere->setFournisseur(FournisseurDTOMapper::fromDTO($dto->getFournisseur()));
        }
        return $matierePremiere;
    }
    public static function toDTO(MatierePremiere $matierePremiere):RepMatPremDTO {
        $dto = new RepMatPremDTO();
        $dto->setId($matierePremiere->getId())
        ->setNom($matierePremiere->getNom())
        ->setNomCour($matierePremiere->getNomCour())
        ->setPmAvantCuisson($matierePremiere->getPmAvantCuisson())
        ->setOrdre($matierePremiere->getOrdre())
        ->setAvertissement($matierePremiere->getAvertissement())
        ->setFlagEtat($matierePremiere->getFlagEtat());
        $arrRepOxDto = [];
        foreach($matierePremiere->getQuantite()->toArray() as $quantiteOxyde){
            $RepOxDto = OxydeDTOMapper::toDTO($quantiteOxyde->getOxyde());
            $RepOxDto->setQuantite($quantiteOxyde->getQuantite());
            $arrRepOxDto[]=$RepOxDto;
        }
        $dto->setOxydes($arrRepOxDto);
        if ($matierePremiere->getFournisseur()){
            $dto->setFournisseur(FournisseurDTOMapper::toDTO($matierePremiere->getFournisseur()));
        }


        // ajouter traitement des oxydes
        return $dto;
    }
}

?>