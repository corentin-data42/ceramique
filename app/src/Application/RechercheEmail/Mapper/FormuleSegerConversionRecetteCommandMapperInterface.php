<?php
namespace Application\RechercheEmail\Mapper;

use Domain\RechercheEmail\Object\ValueObject\FormuleSeger;
use Application\RechercheEmail\Command\FormuleSegerConversionRecetteCommand;
use Application\RechercheEmail\Port\RechercheEmailPort;
use Application\Repository\Query\GetOxydeByIdQuery;
use Application\Repository\Handler\GetOxydeByIdQueryHandler;


interface FormuleSegerConversionRecetteCommandMapperInterface{
    public static function fromArray( array $data):FormuleSeger ;
    }
?>