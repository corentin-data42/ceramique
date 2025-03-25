<?php 

namespace Application\GestionUtilisateur\Mapper;

use Domain\Common\object\Utilisateur ;

interface UtilisateurMapperInterface{

    public function fromArray( array $data): Utilisateur;
    public function toArray( Utilisateur $utilisateur ): array;
}
?>