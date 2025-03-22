<?php

namespace Application\GestionUtilisateur\Port;

use Application\Repository\Port\RepositoryCommandPort;
use Application\Repository\Port\RepositoryQueryPort;

use Application\GestionUtilisateur\Command\AjouteUtilisateurCommand;


interface GestionUtilisateurPort
{
    public static function getInstance(RepositoryCommandPort $repCommandPort,RepositoryQueryPort $repQueryPort);
    public function ajouteUtilisateur(AjouteUtilisateurCommand $command);
    
}
