<?php
    namespace Application\Repository\Handler;
    
    use Application\Repository\DTO\RepMatPremDTOMapper;
    use Application\Repository\Query\GetSegerMatPremQuery;
    use Application\Repository\Port\RepositoryQueryPort;
    

    class GetSegerMatPremQueryHandler{
        
        public function __construct(
            protected RepositoryQueryPort $RepositoryQueryPort
        ){   
        }

        public function handle(GetSegerMatPremQuery $query):array{
            
            $repositoryResult = $this->RepositoryQueryPort->getMatPremByIdOxyde($query->getId(),$query->getActiveOnly());
            $arrMatPrem=[];
            foreach($repositoryResult as $repDTO){
                $arrMatPrem[]=RepMatPremDTOMapper::fromDTO($repDTO);
            }
            return $arrMatPrem;
        }
    }