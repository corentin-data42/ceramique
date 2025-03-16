<?php
    namespace Application\Repository\Handler;
    
    use Domain\Common\Object\Oxyde;
    use Application\Repository\DTO\RepOxDTO;
    use Application\Repository\DTO\RepOxDTOMapper;
    use Application\Repository\Query\GetAllOxydeActifQuery;
    use Application\Repository\Port\RepositoryQueryPort;
    

    class GetAllOxydeActifQueryHandler{
        
        public function __construct(
            protected RepositoryQueryPort $RepositoryQueryPort
        ){   
        }
        // on recoit des DTO est on construit des objets domaine ?
        public function handle(GetAllOxydeActifQuery $query):array{
            if($query->getOrdreBy()==GetAllOxydeActifQuery::__ORDER_BY_TYPE){
                $repositoryResult = $this->RepositoryQueryPort->getAllOxydeActifOrderByType();
            }else{
                $repositoryResult = $this->RepositoryQueryPort->getAllOxydeActif();
            }
            return $this->browseAndMap($repositoryResult);
        }
        private function browseAndMap($repositoryResult):array{
            $arrOxydeDto=[];

            foreach($repositoryResult as $repOxDTO){
                array_push($arrOxydeDto,RepOxDTOMapper::fromDTO($repOxDTO));
            }

            return $arrOxydeDto;
        }
    }