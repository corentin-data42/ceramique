<?php
namespace Application\RechercheEmail\Handler;

use Domain\RechercheEmail\Service\RechEmaConvService;
use Domain\RechercheEmail\Object\StockMatieresPremieres;
use Application\Repository\Port\RepositoryQueryPort;
use Application\RechercheEmail\Port\RechercheEmailPort;

use Application\RechercheEmail\Command\FormuleSegerConversionRecetteCommand;
use Application\RechercheEmail\Mapper\FormuleSegerConversionRecetteCommandMapper;
use Application\RechercheEmail\DTO\RechEmailRecetteDTO;
use Application\RechercheEmail\DTO\RechEmailRecetteDTOMapper;

use Application\Repository\Query\GetSegerMatPremQuery;
use Application\Repository\Handler\GetSegerMatPremQueryHandler;

class FormuleSegerConversionRecetteCommandHandler{
    public function __construct(
        protected RechercheEmailPort $rechercheEmailPort
    ){   
    }
    public function handle(FormuleSegerConversionRecetteCommand $commandDto):void{

        $formuleSeger = FormuleSegerConversionRecetteCommandMapper::fromDTOToFormuleSeger($commandDto,$this->rechercheEmailPort->getRepositoryQueryPort());


        // recuperation matieres premieres active dont tous les oxydes
        // sont dans les oxydes demandé
        $handlerQuery = new GetSegerMatPremQueryHandler($this->rechercheEmailPort->getRepositoryQueryPort());
        $query = new GetSegerMatPremQuery($formuleSeger->getOxydeIdArr());

        $stock = $handlerQuery->handle($query);
        $serviceConversion =new RechEmaConvService();
        if($recette = $serviceConversion->toRecette($formuleSeger,$stock)){

        }
        dd();
        // logique et/ou appel au service



        
    }
}
?>