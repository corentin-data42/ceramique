<?php
    namespace Application\RechercheEmail\Handler;
    
    use Domain\Common\Object\Oxyde;
    use Application\Repository\DTO\OxydeDTO as RepOxDTO;
    use Application\Repository\DTO\OxydeDTOMapper as RepOxDTOMapper;
    use Application\RechercheEmail\DTO\OxydeDTO;
    use Application\RechercheEmail\DTO\OxydeDTOMapper;
    use Application\RechercheEmail\Query\GetAllOxydeActifQuery;
    use Application\RechercheEmail\Port\RechercheEmailPort;
    

    use Application\Repository\Query\GetAllOxydeActifQuery as RepositoryQuery;
    use Application\Repository\Handler\GetAllOxydeActifQueryHandler as RepositoryHandler;
    use Application\Repository\Port\RepositoryQueryPort;

    class GetAllOxydeActifQueryHandler{
        
        public function __construct(
            protected RechercheEmailPort $rechercheEmailPort,
            protected RepositoryQueryPort $repositoryQueryPort,
        ){   
        }

        public function handle(GetAllOxydeActifQuery $query):array{
            //return $this->databasePort->findAllActif();
            $repositoryHandler = new RepositoryHandler( $this->repositoryQueryPort );
            $repositoryQuery = new RepositoryQuery();
            $repositoryQuery->setOrdreBy(RepositoryQuery::__ORDER_BY_TYPE);
            $repositoryResult = $repositoryHandler->handle($repositoryQuery);
            $arrOxydeDto=[];
            foreach($repositoryResult as $repOxDTO){
                array_push($arrOxydeDto,OxydeDTOMapper::toDTO(RepOxDTOMapper::fromDTO($repOxDTO)));
            }
            return $arrOxydeDto;
        }
    }