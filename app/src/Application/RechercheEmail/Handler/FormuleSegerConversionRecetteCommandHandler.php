<?php
namespace Application\RechercheEmail\Handler;

use Application\Repository\Port\RepositoryQueryPort;
use Application\RechercheEmail\Port\RechercheEmailPort;

use Application\RechercheEmail\Command\FormuleSegerConversionRecetteCommand;
use Application\RechercheEmail\Mapper\FormuleSegerConversionRecetteCommandMapper;


use Application\Repository\Query\GetSegerMatPremQuery;
use Application\Repository\Handler\GetSegerMatPremQueryHandler;

class FormuleSegerConversionRecetteCommandHandler{
    public function __construct(
        protected RechercheEmailPort $rechercheEmailPort
    ){   
    }
    public function handle(FormuleSegerConversionRecetteCommand $commandDto):void{

        $formuleSeger = FormuleSegerConversionRecetteCommandMapper::fromDTOToFormuleSeger($commandDto,$this->rechercheEmailPort->getRepositoryQueryPort());


        $handlerQuery = new GetSegerMatPremQueryHandler($this->rechercheEmailPort->getRepositoryQueryPort());
        $query = new GetSegerMatPremQuery($formuleSeger->getOxydeIdArr());

        $arrMatPrem = $handlerQuery->handle($query);
        dd($arrMatPrem);
        // logique et/ou appel au service

        // recuperation matieres premieres active dont tous les oxydes
        // sont dans les oxydes demander

        
    }
}
?>