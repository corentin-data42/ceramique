<?php
namespace UI\GestionUtilisateur\DTO\Mapper;
use App\Entity\Utilisateur;
use Application\GestionUtilisateur\Command\AjouteUtilisateurCommand;
use Symfony\Component\HttpFoundation\Request;

class AjouteUtilisateurCommandMapper{

    public static function utilisateurToCommandDTO(Utilisateur $utilisateur):AjouteUtilisateurCommand {
        
        $commandDto = new AjouteUtilisateurCommand();
        $commandDto->setNom($utilisateur->getNom());
        $commandDto->setEmail($utilisateur->getEmail());
        $commandDto->setRoles($utilisateur->getRoles());
        $commandDto->setFlagEtat($utilisateur->getFlagEtat());
        $commandDto->setPassword($utilisateur->getPassword());

        return $commandDto;
    }
}
?>