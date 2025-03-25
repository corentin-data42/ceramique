<?php namespace App\RepositoryAdaptateur;

use Application\Repository\Port\RepositoryCommandPort;
use Application\Repository\DTO\RepOxDTO;
use Application\Repository\DTO\RepUtilisateurDTO;

use App\Repository\OxydeRepository;
use App\Repository\MatierePremiereRepository;
use App\Repository\MatierePremiereOxydeQuantiteRepository;
use App\Repository\UtilisateurRepository;

use Symfony\Component\Validator\Validation;

use App\DTO\Mapper\UtilisateurDTOMapper;

class RepositoryCommandAdaptateur implements RepositoryCommandPort{
    public function __construct(
        private OxydeRepository $oxydeRepository,
        private MatierePremiereRepository $matierePremiereRepository,
        private MatierePremiereOxydeQuantiteRepository $matierePremiereOxydeQuantiteRepository,
        private UtilisateurRepository $utilisateurRepository,
    )
    {
        //parent::__construct($registry, DoctrineOxyde::class);
    }
    public function saveOxyde(RepOxDTO $oxyde, bool $flush = false){

    }

    public function ajouteUtilisateur(RepUtilisateurDTO $utilisateur, bool $flush = false){
        
        $utilisateur = UtilisateurDTOMapper::fromDTO($utilisateur);
        $utilisateur->setCreationAt(new \DateTimeImmutable())
                    ->setModificationAt(new \DateTimeImmutable());
        $em = $this->utilisateurRepository->getEntityManager();
        // normalement on as validé avant mais par prudence
        $validator = Validation::createValidator();
        if ($validator->validate($utilisateur)){
            $em = $this->utilisateurRepository->getEntityManager();
            $em->persist($utilisateur);
            if($flush){
                $em->flush();
            }
        }
    }
}
?>