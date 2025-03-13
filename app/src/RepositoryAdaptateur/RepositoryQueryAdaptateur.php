<?php
namespace App\RepositoryAdaptateur;
use Application\Repository\Port\RepositoryQueryPort;
use Application\Repository\DTO\RepOxDTO;

use App\Entity\Oxyde;
use App\Repository\OxydeRepository;
use App\Repository\MatierePremiereRepository;
use App\Repository\MatierePremiereOxydeQuantiteRepository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

use App\DTO\Mapper\OxydeDTOMapper;
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
        $oxydes = $this->oxydeRepository->findAllActifOrderByType();
        
        $arrOxydesDTO=[];
        foreach($oxydes as $oxyde){
            array_push($arrOxydesDTO,OxydeDTOMapper::toDTO($oxyde));
        }
        return $arrOxydesDTO;
    }
}
?>