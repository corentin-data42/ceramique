<?php
namespace App\UI\Repository;
use Application\Repository\Port\RepositoryQueryPort;
use App\Entity\DoctrineOxyde;
use App\Repository\DoctrineOxydeRepository;
use App\Repository\DoctrineMatierePremiereRepository;
use App\Repository\DoctrineMatierePremiereOxydeRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class RepositoryQueryAdaptateur implements RepositoryQueryPort{
    
    public function __construct(
            private DoctrineOxydeRepository $oxydeRepository,
            private DoctrineMatierePremiereRepository $matierePremiereRepository,
            private DoctrineMatierePremiereOxydeRepository $matierePremiereOxydeRepository
    )
    {
        //parent::__construct($registry, DoctrineOxyde::class);
    }
    public function getOneOxydeById(int $id){

    }
    public function getAllOxydeActif():array{
        $doctrineOxyde = new DoctrineOxyde();
        
        //$repository = new DoctrineOxydeRepository();
        return [];
    }
    public function getAllOxydeActifOrderByType():array{
        return $this->oxydeRepository->findAllActifOrderByType();
    }
}
?>