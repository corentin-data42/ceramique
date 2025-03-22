<?php
namespace App\DTO\Mapper;

use App\Entity\Utilisateur;
use Application\Repository\DTO\RepUtilisateurDTO;

class UtilisateurDTOMapper{
    public static function fromDTO(RepUtilisateurDTO $dto):Utilisateur {

        $utilisateur = new Utilisateur();
        if ($dto->getId()){
            $utilisateur->setId($dto->getId());
        }
        if ($dto->getCreationAt()){
            $utilisateur->setCreationAt($dto->getCreationAt());
        }if ($dto->getModificationAt()){
            $utilisateur->setModificationAt($dto->getModificationAt());
        }
        $utilisateur->setNom($dto->getNom())
            ->setEmail($dto->getEmail())
            ->setRoles($dto->getRoles())
            ->setPassword($dto->getPassword())
            ->setFlagEtat($dto->getFlagEtat());
        return $utilisateur;
    }
    public static function toDTO(Utilisateur $utilisateur):RepUtilisateurDTO {

        $dto = new RepUtilisateurDTO();
        $dto->setId($utilisateur->getId())
            ->setNom($utilisateur->getNom())
            ->setEmail($utilisateur->getEmail())
            ->setPassword($utilisateur->getPassword())
            ->setRoles($utilisateur->getRoles())
            ->setCreationAt($utilisateur->getCreationAt())
            ->setModificationAt($utilisateur->getModificationAt())
            ->setFlagEtat($utilisateur->getFlagEtat());

        return $dto;
    }
}

?>