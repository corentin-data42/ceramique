<?php
namespace UI\RechercheEmail\DTO\Mapper;

use Application\RechercheEmail\Command\FormuleSegerConversionRecetteCommand;
use Symfony\Component\HttpFoundation\Request;

class FormuleSegerConversionRecetteCommandMapper{
    public static function requestToCommandDTO(Request $request):FormuleSegerConversionRecetteCommand {

        $requestParam = $request->get('formule_seger');
        $oxydes = [];
        foreach($requestParam as $type){
            if(is_array($type)){
                foreach($type as $oxydeId=>$quantite){
                    if($quantite['quantite']>0){
                        $oxydes[$oxydeId]=$quantite['quantite'];
                    }
                }
            }
        }
        $commandDto = new FormuleSegerConversionRecetteCommand();
        $commandDto->setOxydes($oxydes);
        return $commandDto;
    }
}
?>