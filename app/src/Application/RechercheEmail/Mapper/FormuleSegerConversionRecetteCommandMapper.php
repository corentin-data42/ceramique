<?php
namespace Application\RechercheEmail\Mapper;

use Domain\RechercheEmail\Object\ValueObject\FormuleSeger;
use Application\RechercheEmail\Command\FormuleSegerConversionRecetteCommand;

use Application\Common\Query\GetAllOxydeActifQuery as QueryDb;
use Application\Common\Handler\GetAllOxydeActifQueryHandler as DbQueryHandler;
use Application\Common\Port\Database\OxydeDatabasePort;


class FormuleSegerConversionRecetteCommandMapper{
    public static function fromDTOToFormuleSeger(FormuleSegerConversionRecetteCommand $commandDto):FormuleSeger {
        /// constusruire les oxyde ici est les ajouter a lobjet value seger ???
        // faire appelle database port ici ???
        /// 
        // $oxyde 
        // $handleDb = new DbQueryHandler( $this->oxydeDatabasePort );
        // $queryDb = new QueryDb();
        // $queryDb->setOrdreBy(QueryDb::__ORDER_BY_TYPE);
        // return $handleDb->handle($queryDb);
        dd($commandDto);
        $formuleSeger = FormuleSeger::constructeur([],[],[]);
        return $formuleSeger;
    }
}
?>