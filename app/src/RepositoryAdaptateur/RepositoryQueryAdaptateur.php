<?php
namespace App\RepositoryAdaptateur;
use Application\Repository\Port\RepositoryQueryPort;
use Application\Repository\DTO\RepOxDTO;

use App\Entity\Oxyde;
use App\Repository\OxydeRepository;
use App\Repository\MatierePremiereRepository;
use App\Repository\MatierePremiereOxydeQuantiteRepository;
use App\Repository\UtilisateurRepository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

use App\DTO\Mapper\OxydeDTOMapper;
use App\DTO\Mapper\MatPremDTOMapper;
class RepositoryQueryAdaptateur implements RepositoryQueryPort{
    
    public function __construct(
        private OxydeRepository $oxydeRepository,
        private MatierePremiereRepository $matierePremiereRepository,
        private MatierePremiereOxydeQuantiteRepository $matierePremiereOxydeQuantiteRepository,
        private UtilisateurRepository $utilisateurRepository,
    )
    {

    }
    public function getOneOxydeById(int $id){

    }
    public function getOxydeById(array $arrId, ?bool $actifOnly = true):array{
        $oxydes = $this->oxydeRepository->findById($arrId,$actifOnly);
        $arrOxydesDTO=[];
        foreach($oxydes as $oxyde){
            array_push($arrOxydesDTO,OxydeDTOMapper::toDTO($oxyde));
        }
        return $arrOxydesDTO;
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
            $arrOxydesDTO[]=OxydeDTOMapper::toDTO($oxyde);
        }
        return $arrOxydesDTO;
    }

    public function getMatPremByIdOxyde(array $arrId, ?bool $actifOnly = true):array{
        $arrMatPrem = $this->matierePremiereRepository->findWithOxydeIn($arrId,$actifOnly);
        
        $arrMatPremDTO=[];
        foreach($arrMatPrem as $maPrem){
            $maPrem->getQuantite()->initialize();
            //if($maPrem->getFournisseur()){
                //dump($maPrem->getFournisseur());
            //}
            
            $arrMatPremDTO[]=MatPremDTOMapper::toDTO($maPrem);
        }
        return $arrMatPremDTO;
    }
    
}
?>