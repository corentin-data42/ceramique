<?php

namespace Application\RechercheEmail\Port;

use Application\Repository\Port\RepositoryCommandPort;
use Application\Repository\Port\RepositoryQueryPort;

use Application\RechercheEmail\Command\FormuleSegerConversionRecetteCommand;
use Application\RechercheEmail\Query\GetAllOxydeActifQuery;


interface RechercheEmailPort
{
    public static function getInstance(RepositoryCommandPort $repCommandPort,RepositoryQueryPort $repQueryPort);
    public function convSegerRecette(FormuleSegerConversionRecetteCommand $command);
    //public function save(OxydeDTO $oxyde, bool $flush = false);
    public function getAllOxydeActif(GetAllOxydeActifQuery $query):array;
    public function getRepositoryQueryPort():RepositoryQueryPort;
    public function getRepositoryCommandPort():RepositoryCommandPort;
}
