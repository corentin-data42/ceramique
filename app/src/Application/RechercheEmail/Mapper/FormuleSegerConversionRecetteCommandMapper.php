<?php
namespace Application\RechercheEmail\Mapper;

use Domain\RechercheEmail\Object\ValueObject\FormuleSeger;
use Application\RechercheEmail\Command\FormuleSegerConversionRecetteCommand;
use Application\RechercheEmail\Port\RechercheEmailPort;
use Application\Repository\Query\GetOxydeByIdQuery;
use Application\Repository\Handler\GetOxydeByIdQueryHandler;


class FormuleSegerConversionRecetteCommandMapper{
    public static function fromDTOToFormuleSeger(
            FormuleSegerConversionRecetteCommand $commandDto,
            $repositoryQuery):FormuleSeger {

        $arrIdOxydes=[];
        foreach($commandDto->getOxydes() as $idOxyde=>$quantiteOxyde){
           array_push($arrIdOxydes,$idOxyde); 
        }
        $handleDb = new GetOxydeByIdQueryHandler( $repositoryQuery );
        $queryDb = new GetOxydeByIdQuery($arrIdOxydes);
        
        $arrOxydes = $handleDb->handle($queryDb);
        foreach($arrOxydes as $ox){
            $ox->setQuantite($commandDto->getOxydes()[$ox->getId()]);
        }
        
        $formuleSeger = FormuleSeger::constructeur($arrOxydes);
        return $formuleSeger;
    }
}
?>