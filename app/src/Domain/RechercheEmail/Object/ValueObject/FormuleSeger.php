<?php
namespace Domain\RechercheEmail\Object\ValueObject;
use Domain\Common\Object\Oxyde;



// final no extend
final class FormuleSeger{

    private array $basique =[];
    private array $amphotere= [];
    private array $acide = [];
    private const TYPE_BASIQUE = 1;
    private const TYPE_AMPHOTERE = 2;
    private const TYPE_ACIDE = 2;
    private function __construct(array $oxydes)
    {
        foreach($oxydes as $oxyde){
            switch($oxyde->getType()){
                case SELF::TYPE_BASIQUE:
                    $this->basique[]=$oxyde;
                    break;
                case SELF::TYPE_AMPHOTERE:
                    $this->amphotere[]=$oxyde;
                    break;
                case SELF::TYPE_ACIDE:
                    $this->acide[]=$oxyde;
                    break;

            }
        }
       
        // Regle de Validation metier l'ensemble des oxyde basique d'une formule doit etre egal a 1
        $totalQuantiteBasique = 0;
        foreach($this->basique as $oxBasique){
            $totalQuantiteBasique += $oxBasique->getQuantite();
        }
        
        if($totalQuantiteBasique !== 1.0){
            throw new \InvalidArgumentException('Le total des oxydes de la colonne basique doit etre egal a 1.');
        }
    }

    // constructeur Nommé pour evité de pouvoir modifier l'instance immuable
    public static function constructeur($oxydes){
        return new FormuleSeger($oxydes);
    }

    /**
     * return array 
     */
    public function getOxydeIdArr():array{
        $arrOxydeId=[];
        foreach($this->basique as $ox){
            $arrOxydeId[]=$ox->getId();
        }
        foreach($this->amphotere as $ox){
            $arrOxydeId[]=$ox->getId();
        }
        foreach($this->acide as $ox){
            $arrOxydeId[]=$ox->getId();
        }
        return $arrOxydeId;
    }

}
?>