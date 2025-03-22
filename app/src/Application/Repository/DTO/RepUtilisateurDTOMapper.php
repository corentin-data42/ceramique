<?php namespace Application\Repository\DTO;

use Domain\Common\Object\Utilisateur;

use Application\Repository\DTO\RepUtilisateurDTO;
use Application\Repository\Command\CreateUtilisateurCommand;
class RepUtilisateurDTOMapper{
    public static function toDTO(Utilisateur $entity): RepUtilisateurDTO {
        
        $dto = new RepUtilisateurDTO();
        $dto->setId($entity->getId());
        $dto->setNom($entity->getNom());
        $dto->setPassword($entity->getPassword());
        $dto->setRoles($entity->getRoles()->toArray());
        $dto->setEmail($entity->getEmail());
        $dto->setFlagEtat($entity->getFlagEtat());

        return $dto;
    }
    public static function fromDTO(RepUtilisateurDTO $dto):Utilisateur {

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
    public static function createCommandToDTO(CreateUtilisateurCommand $command):RepUtilisateurDTO {

        $dto = new RepUtilisateurDTO();
        //$dto->setId($command->getId());
        $dto->setNom($command->getNom());
        $dto->setPassword($command->getPassword());
        $dto->setRoles($command->getRoles());
        $dto->setEmail($command->getEmail());
        $dto->setFlagEtat($command->getFlagEtat());
        return $dto;
    }
}

?>