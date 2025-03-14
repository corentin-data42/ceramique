<?php
    namespace Application\Repository\Handler;
    
    use Domain\Common\Object\Oxyde;
    use Application\Repository\DTO\OxydeDTO;
    use Application\Repository\DTO\RepOxDTOMapper;
    use Application\Repository\Query\GetSegerMatPremQuery;
    use Application\Repository\Port\RepositoryQueryPort;
    

    class GetSegerMatPremQueryHandler{
        
        public function __construct(
            protected RepositoryQueryPort $RepositoryQueryPort
        ){   
        }

        public function handle(GetSegerMatPremQuery $query):array{
            $repositoryResult = $this->RepositoryQueryPort->getMatPremByIdOxyde($query->getId(),$query->getActiveOnly());
            $arrMatPremDto=[];
            foreach($repositoryResult as $repDTO){
                $arrMatPremDto[]=RepOxDTOMapper::fromDTO($repDTO);
            }
            return $arrMatPremDto;
        }
    }