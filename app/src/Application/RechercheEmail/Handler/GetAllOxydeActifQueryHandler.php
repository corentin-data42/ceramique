<?php
    namespace Application\RechercheEmail\Handler;
    
    use Domain\Common\Object\Oxyde;



    use Application\RechercheEmail\DTO\RechEmailOxDTO;
    use Application\RechercheEmail\DTO\RechEmailOxDTOMapper;
    use Application\RechercheEmail\Query\GetAllOxydeActifQuery;
    use Application\RechercheEmail\Port\RechercheEmailPort;
    
    use Application\Repository\DTO\RepOxDTO;
    use Application\Repository\DTO\RepOxDTOMapper;
    use Application\Repository\Query\GetAllOxydeActifQuery as RepositoryQuery;
    use Application\Repository\Handler\GetAllOxydeActifQueryHandler as RepositoryHandler;
    use Application\Repository\Port\RepositoryQueryPort;

    class GetAllOxydeActifQueryHandler{
        
        public function __construct(
            protected RechercheEmailPort $rechercheEmailPort,
        ){   
        }

        public function handle(GetAllOxydeActifQuery $query):array{
            //return $this->databasePort->findAllActif();
            $repositoryHandler = new RepositoryHandler( $this->rechercheEmailPort->getRepositoryQueryPort() );
            $repositoryQuery = new RepositoryQuery();
            $repositoryQuery->setOrdreBy(RepositoryQuery::__ORDER_BY_TYPE);
            $arrDomainOx = $repositoryHandler->handle($repositoryQuery);
            
            return $this->browseAndMap($arrDomainOx);
        }
        private function browseAndMap($arrDomainOx){
            $arrOxydeDto=[];
            foreach($arrDomainOx as $oxyde){
                array_push($arrOxydeDto,RechEmailOxDTOMapper::toDTO($oxyde));
            }

            return $arrOxydeDto;
        }
    }