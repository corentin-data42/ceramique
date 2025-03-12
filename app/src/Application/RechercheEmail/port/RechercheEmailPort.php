<?php

namespace Application\RechercheEmail\Port;

use Application\Common\Port\Database\OxydeDatabasePort;
use Application\RechercheEmail\Command\FormuleSegerConversionRecetteCommand;
use Application\RechercheEmail\Query\GetAllOxydeActifQuery;

interface RechercheEmailPort
{

    public function convSegerRecette(FormuleSegerConversionRecetteCommand $command);
    //public function save(OxydeDTO $oxyde, bool $flush = false);
    public function getAllOxydeActif(GetAllOxydeActifQuery $query):array;
}
