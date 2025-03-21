<?php declare(strict_types=1);

namespace Application\Repository\DTO;
use Domain\Common\Object\Fournisseur;
use Application\Repository\DTO\RepFournisseurDTO;

class RepFournisseurDTOMapper{
    public static function toDto(Fournisseur $fournisseur): RepFournisseurDTO{
        $dto = new RepFournisseurDTO();
        $dto->setId($fournisseur->getId());
        $dto->setNom($fournisseur->getNom());
        $dto->setFlagEtat($fournisseur->getFlagEtat());
        return $dto;
    }
    public static function fromDto(RepFournisseurDTO $dto): Fournisseur{
        $fournisseur = new Fournisseur();
        $fournisseur->setId($dto->getId());
        $fournisseur->setNom($dto->getNom());
        $fournisseur->setFlagEtat($dto->getFlagEtat());
        return $fournisseur;
    }

}

?>