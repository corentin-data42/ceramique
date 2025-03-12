<?php namespace App\UI\Repository;

use Application\Repository\Port\RepositoryCommandPort;
use Application\Repository\DTO\OxydeDTO;

use App\Repository\OxydeRepository;
use App\Repository\MatierePremiereRepository;
use App\Repository\MatierePremiereOxydeQuantiteRepository;

class RepositoryCommandAdaptateur implements RepositoryCommandPort{
    public function __construct(
        private OxydeRepository $oxydeRepository,
        private MatierePremiereRepository $matierePremiereRepository,
        private MatierePremiereOxydeQuantiteRepository $matierePremiereOxydeQuantiteRepository
    )
    {
        //parent::__construct($registry, DoctrineOxyde::class);
    }
    public function saveOxyde(OxydeDTO $oxyde, bool $flush = false){

    }
}
?>