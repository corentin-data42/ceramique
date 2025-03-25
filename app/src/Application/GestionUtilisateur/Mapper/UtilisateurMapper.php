<?php 
    declare(strict_types=1);

    namespace Application\GestionUtilisateur\Mapper;
              
    use Application\GestionUtilisateur\Mapper\UtilisateurMapperInterface;

    use Domain\Common\object\Utilisateur as Utilisateur;

    class UtilisateurMapper{

        public function toArray( Utilisateur $utilisateur): array{
            $data = [];
            $data["nom"] = $utilisateur->getNom();
            $data["email"] = $utilisateur->getEmail();
            $data["password"] = $utilisateur->getPassword();
            $data["flagEtat"] = $utilisateur->getFlagEtat();
            $data["id"] = $utilisateur->getId();
            $data["roles"] = $utilisateur->getRoles()->toArray();
            return $data;
        }

        public function fromArray( array $data): Utilisateur{
            $utilisateur = new Utilisateur(
                $data['nom'],
                $data['email'],
                $data['password'],
                $data['flagEtat'],
                $data['id'],
            );
            foreach( $data['roles'] as $key => $value ){
                $utilisateur->getRoles()->add($value);
            }
            return $utilisateur;
        }


    }
?>