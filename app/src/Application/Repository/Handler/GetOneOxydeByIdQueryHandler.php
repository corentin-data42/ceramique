<?php
    namespace Application\Repository\Handler;
    
    use Domain\Common\Object\Oxyde;
    use Application\Repository\DTO\OxydeDTO;
    use Application\Repository\Query\GetOneOxydeByIdQuery;
    use Application\Repository\Port\RepositoryQueryPort;
    

    class FindOneOxydeByIdQueryHandler{
        
        public function __construct(
            protected RepositoryQueryPort $RepositoryQueryPort
        ){   
        }

        public function handle(GetOneOxydeByIdQuery $query):array{
            return $this->RepositoryQueryPort->getOneOxydeById($query->getId());
        }
    }