<?php
namespace Domain\RechercheEmail\Object\ValueObject;
use Domain\Common\Object\OxydeQuantite;



// final no extend
final class FormuleSeger{

    private array $basiques;
    private array $amphoteres;
    private array $acides;

    private function __construct(array $basiques,array $amphoteres,array $acides)
    {
        // Regle de Validation metier l'ensemble des oxyde basique d'une formule doit etre egal a 1
        $totalQuantiteBasiques = 0;
        foreach($basiques as $oxBasique){
            $totalQuantiteBasiques += $oxBasique->quantite;
        }
        if($totalQuantiteBasiques !== 1){
            throw new \InvalidArgumentException('Le total des oxydes de la colonne basique doit etre egal a 1.');
        }
        $this->basiques=$basiques;
        $this->amphoteres=$amphoteres;
        $this->acides=$acides;
    }

    // constructeur Nommé pour evité de pouvoir modifier l'instance immuable
    public static function constructeur(array $basiques,array $amphoteres,array $acides){
        return new FormuleSeger($basiques,$amphoteres,$acides);
    }

}
?>