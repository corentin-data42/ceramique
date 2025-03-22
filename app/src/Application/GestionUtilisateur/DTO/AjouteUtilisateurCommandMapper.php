<?php declare(strict_types=1);
namespace Application\GestionUtilisateur\DTO;
use Application\GestionUtilisateur\Command\AjouteUtilisateurCommand;
use Application\Repository\DTO\RepUtilisateurDTO;
use Domain\Common\Object\Utilisateur;

class AjouteUtilisateurCommandMapper{
    public static function fromDTO(AjouteUtilisateurCommand $dto):Utilisateur {

        $entity = new Utilisateur();
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