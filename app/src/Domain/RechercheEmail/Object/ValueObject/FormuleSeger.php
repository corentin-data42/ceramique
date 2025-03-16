<?php
namespace Domain\RechercheEmail\Object\ValueObject;
use Domain\Common\Object\Oxyde;
use Domain\Common\Object\Collection;



// final no extend
final class FormuleSeger{

    private Collection $basique;
    private Collection $amphotere;
    private Collection $acide;
    private const TYPE_BASIQUE = 1;
    private const TYPE_AMPHOTERE = 2;
    private const TYPE_ACIDE = 3;
    private function __construct(array $oxydes)
    {
        $this->basique =new Collection();
        $this->amphotere =new Collection();
        $this->acide =new Collection();
        foreach($oxydes as $oxyde){
            switch($oxyde->getType()){
                case SELF::TYPE_BASIQUE:
                    $this->basique->add($oxyde);
                    break;
                case SELF::TYPE_AMPHOTERE:
                    $this->amphotere->add($oxyde);
                    break;
                case SELF::TYPE_ACIDE:
                    $this->acide->add($oxyde);
                    break;

            }
        }
       
        // Regle de Validation metier l'ensemble des oxyde basique d'une formule doit etre egal a 1
        $totalQuantiteBasique = 0;
        foreach($this->basique->toArray() as $oxBasique){
            $totalQuantiteBasique += $oxBasique->getQuantite();
        }
        
        if(round($totalQuantiteBasique,4)<>round(1.0,4)){
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
        foreach($this->basique->toArray() as $ox){
            $arrOxydeId[]=$ox->getId();
        }
        foreach($this->amphotere->toArray() as $ox){
            $arrOxydeId[]=$ox->getId();
        }
        foreach($this->acide->toArray() as $ox){
            $arrOxydeId[]=$ox->getId();
        }
        return $arrOxydeId;
    }

}
?>