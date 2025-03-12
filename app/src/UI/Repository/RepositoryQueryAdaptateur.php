<?php
namespace App\UI\Repository;
use Application\Repository\Port\RepositoryQueryPort;
use App\Entity\Oxyde;
use App\Repository\OxydeRepository;
use App\Repository\MatierePremiereRepository;
use App\Repository\MatierePremiereOxydeQuantiteRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class RepositoryQueryAdaptateur implements RepositoryQueryPort{
    
    public function __construct(
            private OxydeRepository $oxydeRepository,
            private MatierePremiereRepository $matierePremiereRepository,
            private MatierePremiereOxydeQuantiteRepository $matierePremiereOxydeQuantiteRepository
    )
    {

    }
    public function getOneOxydeById(int $id){

    }
    public function getAllOxydeActif():array{
        $doctrineOxyde = new Oxyde();
        
        //$repository = new DoctrineOxydeRepository();
        return [];
    }
    public function getAllOxydeActifOrderByType():array{
        return $this->oxydeRepository->findAllActifOrderByType();
    }
}
?>