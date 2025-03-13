<?php
    namespace Application\Repository\Handler;
    
    use Domain\Common\Object\Oxyde;
    use Application\Repository\DTO\OxydeDTO;
    use Application\Repository\DTO\RepOxDTOMapper;
    use Application\Repository\Query\GetSegerMatPremQuery;
    use Application\Repository\Port\RepositoryQueryPort;
    

    class GetOxydeByIdQueryHandler{
        
        public function __construct(
            protected RepositoryQueryPort $RepositoryQueryPort
        ){   
        }

        public function handle(GetSegerMatPremQuery $query):array{
            $repositoryResult = $this->RepositoryQueryPort->getMatPremByIdOxyde($query->getId(),$query->getActiveOnly());
            $arrOxydeDto=[];
            foreach($repositoryResult as $repDTO){
                $arrOxydeDto[]=RepOxDTOMapper::fromDTO($repDTO);
            }
            return $arrOxydeDto;
        }
    }