<?php namespace Application\GestionUtilisateur\DTO;

use Domain\GestionUtilisateur\Object\Utilisateur;

use Application\GestionUtilisateur\DTO\UtilisateurDTO;

class UtilisateurDTOMapper{
    public static function toDTO(Utilisateur $entity): UtilisateurDTO {
        
        $dto = new UtilisateurDTO();
        $dto->setId($entity->getId());
        $dto->setNom($entity->getNom());
        $dto->setPassword($entity->getPassword());
        $dto->setRoles($entity->getRoles()->toArray());
        $dto->setEmail($entity->getEmail());
        $dto->setFlagEtat($entity->getFlagEtat());

        return $dto;
    }
    public static function fromDTO(UtilisateurDTO $dto):Utilisateur {

        $entity = new Utilisateur();
        $entity->setId($dto->getId());
        $entity->setNom($dto->getNom());
        $entity->setPassword($dto->getPassword());
        foreach($dto->getRoles()as $role){
            $entity->getRoles()->add($role);
        }
        $entity->setEmail($dto->getEmail());
        $entity->setFlagEtat($dto->getFlagEtat());
        return $entity;
    }
}

?>