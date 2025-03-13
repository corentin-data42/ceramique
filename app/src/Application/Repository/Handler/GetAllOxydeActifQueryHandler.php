<?php
    namespace Application\Repository\Handler;
    
    use Domain\Common\Object\Oxyde;
    use Application\Repository\DTO\OxydeDTO;
    use Application\Repository\Query\GetAllOxydeActifQuery;
    use Application\Repository\Port\RepositoryQueryPort;
    

    class GetAllOxydeActifQueryHandler{
        
        public function __construct(
            protected RepositoryQueryPort $RepositoryQueryPort
        ){   
        }
        // on recoit des DTO est on construit des objets domaine
        public function handle(GetAllOxydeActifQuery $query):array{
            if($query->getOrdreBy()==GetAllOxydeActifQuery::__ORDER_BY_TYPE){
                return $this->RepositoryQueryPort->getAllOxydeActifOrderByType();
            }else{
                return $this->RepositoryQueryPort->getAllOxydeActif();
            }
            
        }
    }