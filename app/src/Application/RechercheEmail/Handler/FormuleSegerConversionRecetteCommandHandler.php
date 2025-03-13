<?php
namespace Application\RechercheEmail\Handler;

use Application\Repository\Port\RepositoryQueryPort;
use Application\RechercheEmail\Port\RechercheEmailPort;

use Application\RechercheEmail\Command\FormuleSegerConversionRecetteCommand;
use Application\RechercheEmail\Mapper\FormuleSegerConversionRecetteCommandMapper;

class FormuleSegerConversionRecetteCommandHandler{
    public function __construct(
        protected RechercheEmailPort $rechercheEmailPort
    ){   
    }
    public function handle(FormuleSegerConversionRecetteCommand $commandDto):void{
        foreach($commandDto->getOxydes() as $oxydes){
            
        }
        $formuleSeger = FormuleSegerConversionRecetteCommandMapper::fromDTOToFormuleSeger($commandDto,$this->rechercheEmailPort->repositoryQueryPort);
        
        // logique et/ou appel au service
    }
}
?>