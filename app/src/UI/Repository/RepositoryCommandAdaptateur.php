<?php namespace App\UI\Repository;

use Application\Repository\Port\RepositoryCommandPort;
use Application\Repository\DTO\OxydeDTO;

use App\Repository\DoctrineOxydeRepository;
use App\Repository\DoctrineMatierePremiereRepository;
use App\Repository\DoctrineMatierePremiereOxydeRepository;

class RepositoryCommandAdaptateur implements RepositoryCommandPort{
    public function __construct(
        private DoctrineOxydeRepository $oxydeRepository,
        private DoctrineMatierePremiereRepository $matierePremiereRepository,
        private DoctrineMatierePremiereOxydeRepository $matierePremiereOxydeRepository
    )
    {
        //parent::__construct($registry, DoctrineOxyde::class);
    }
    public function saveOxyde(OxydeDTO $oxyde, bool $flush = false){

    }
}
?>