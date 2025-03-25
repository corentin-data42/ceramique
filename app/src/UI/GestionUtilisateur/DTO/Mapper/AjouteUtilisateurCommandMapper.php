<?php
namespace UI\GestionUtilisateur\DTO\Mapper;
use App\Entity\Utilisateur;
use Application\GestionUtilisateur\Command\AjouteUtilisateurCommand;
use Symfony\Component\HttpFoundation\Request;

class AjouteUtilisateurCommandMapper{

    public static function utilisateurToCommandDTO(Utilisateur $utilisateur):AjouteUtilisateurCommand {
        
        $commandDto = new AjouteUtilisateurCommand(
            $utilisateur->getNom(),
            $utilisateur->getPassword(),
            $utilisateur->getEmail(),
            $utilisateur->getRoles(),
            $utilisateur->getFlagEtat()
        );


        return $commandDto;
    }
}
?>