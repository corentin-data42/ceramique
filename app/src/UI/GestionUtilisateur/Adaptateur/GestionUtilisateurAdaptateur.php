<?php

namespace UI\GestionUtilisateur\Adaptateur;


use Application\Repository\Port\RepositoryCommandPort;
use Application\Repository\Port\RepositoryQueryPort;
use Application\GestionUtilisateur\Port\GestionUtilisateurPort;

use Application\GestionUtilisateur\Handler\AjouteUtilisateurCommandHandler;
use Application\GestionUtilisateur\Command\AjouteUtilisateurCommand;

final class GestionUtilisateurAdaptateur implements GestionUtilisateurPort

{
    private static GestionUtilisateurAdaptateur $_instance;

    //private RechercheEmailPort $rechercheEmailPort;

    private function __construct(
        private RepositoryCommandPort $repositoryCommandPort,
        private RepositoryQueryPort $repositoryQueryPort,
    )
    {

    }

    // constructeur Nommé pour evité de pouvoir modifier l'instance immuable
    public static function getInstance(
            ?RepositoryCommandPort $repositoryCommandPort=null,
            ?RepositoryQueryPort $repositoryQueryPort=null
        ):GestionUtilisateurAdaptateur{
        if(!isset(self::$_instance)){
            self::$_instance = new GestionUtilisateurAdaptateur(
                $repositoryCommandPort,
                $repositoryQueryPort
        );
        }
        return self::$_instance;
    }

    public function ajouteUtilisateur(AjouteUtilisateurCommand $command){
        $handler = new AjouteUtilisateurCommandHandler($this);
        return $handler->handle($command);
    }

    public function getRepositoryQueryPort():RepositoryQueryPort{
        return $this->repositoryQueryPort;
    }
    public function getRepositoryCommandPort():RepositoryCommandPort{
        return $this->repositoryCommandPort;
    }

}
