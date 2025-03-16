<?php
    namespace Application\Repository\Handler;
    use Domain\RechercheEmail\Object\StockMatieresPremieres;
    use Application\Repository\DTO\RepMatPremDTOMapper;
    use Application\Repository\Query\GetSegerMatPremQuery;
    use Application\Repository\Port\RepositoryQueryPort;
    

    class GetSegerMatPremQueryHandler{
        
        public function __construct(
            protected RepositoryQueryPort $RepositoryQueryPort
        ){   
        }

        public function handle(GetSegerMatPremQuery $query):StockMatieresPremieres{
            
            $repositoryResult = $this->RepositoryQueryPort->getMatPremByIdOxyde($query->getId(),$query->getActiveOnly());
            $stock = new StockMatieresPremieres();
            foreach($repositoryResult as $repDTO){
                $stock->add(RepMatPremDTOMapper::fromDTO($repDTO));
            }
            return $stock;
        }
    }