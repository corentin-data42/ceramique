<?php

namespace UI\RechercheEmail\Adaptateur;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Application\Repository\Port\RepositoryCommandPort;
use Application\Repository\Port\RepositoryQueryPort;
use Application\RechercheEmail\Port\RechercheEmailPort;

use Application\RechercheEmail\Handler\FormuleSegerConversionRecetteCommandHandler;
use Application\RechercheEmail\Command\FormuleSegerConversionRecetteCommand;

use Application\RechercheEmail\Handler\GetAllOxydeActifQueryHandler;
use Application\RechercheEmail\Query\GetAllOxydeActifQuery;

#use Domain\Common\Object\Oxyde;

final class RechercheEmailAdaptateur implements RechercheEmailPort

{
    private static RechercheEmailAdaptateur $_instance;
    public RepositoryCommandPort $repositoryCommandPort;
    public RepositoryQueryPort $repositoryQueryPort;
    //private RechercheEmailPort $rechercheEmailPort;

    private function __construct()
    {

    }

    // constructeur Nommé pour evité de pouvoir modifier l'instance immuable
    public static function getInstance(
            ?RepositoryCommandPort $repositoryCommandPort=null,
            ?RepositoryQueryPort $repositoryQueryPort=null
        ):RechercheEmailAdaptateur{
        if(!isset(self::$_instance)){
            self::$_instance = new RechercheEmailAdaptateur();
            self::$_instance->repositoryCommandPort = $repositoryCommandPort;
            self::$_instance->repositoryQueryPort = $repositoryQueryPort;
        }
        return self::$_instance;
    }

    public function convSegerRecette(FormuleSegerConversionRecetteCommand $command){
        $handler = new FormuleSegerConversionRecetteCommandHandler($this,$this->repositoryQueryPort);
        return $handler->handle($command);
    }
    public function getAllOxydeActif(GetAllOxydeActifQuery $query): array
    {
        $handler = new GetAllOxydeActifQueryHandler($this);
        return $handler->handle($query);
    }
    public function getRepositoryQueryPort():RepositoryQueryPort{
        return $this->repositoryQueryPort;
    }
    public function getRepositoryCommandPort():RepositoryCommandPort{
        return $this->repositoryCommandPort;
    }
}
