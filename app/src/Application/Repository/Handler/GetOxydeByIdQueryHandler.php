<?php
    namespace Application\Repository\Handler;
    
    use Domain\Common\Object\Oxyde;
    use Application\Repository\DTO\OxydeDTO;
    use Application\Repository\DTO\RepOxDTOMapper;
    use Application\Repository\Query\GetOxydeByIdQuery;
    use Application\Repository\Port\RepositoryQueryPort;
    

    class GetOxydeByIdQueryHandler{
        
        public function __construct(
            protected RepositoryQueryPort $RepositoryQueryPort
        ){   
        }

        public function handle(GetOxydeByIdQuery $query):array{
            $repositoryResult = $this->RepositoryQueryPort->getOxydeById($query->getId(),$query->getActifOnly());
            $arrOxydeDto=[];
            foreach($repositoryResult as $repOxDTO){
                array_push($arrOxydeDto,RepOxDTOMapper::fromDTO($repOxDTO));
            }
            return $arrOxydeDto;
        }
    }