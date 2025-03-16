<?php
namespace Domain\RechercheEmail\Service;
/**
 * Classe Service Conversion recherche Email
 * 
 */
 use Domain\RechercheEmail\Object\ValueObject\FormuleSeger;
 use Domain\RechercheEmail\Object\Recette;
 use Domain\RechercheEmail\Object\RecetteMatierePremiere;
 use Domain\Common\Object\MatierePremiere;
 use Domain\RechercheEmail\Object\StockMatieresPremieres;





 final class RechEmaConvService{

    /**
     * @formuleSeger FormuleSeger
     * @StockMatieresPremieres StockMatieresPremieres
     * return Recette
     */
    public function toRecette(FormuleSeger $formuleSeger, StockMatieresPremieres $stockMatPrem):?Recette
    {
        //dump($formuleSeger);
        dump($stockMatPrem);

        $stockMatPrem = $this->ordonneMatieresPremieres($stockMatPrem);
        dump($stockMatPrem);

        return new Recette();
    }

    /**
     * @param matieresPremieres array MatierePremiere
     * return array MatierePremiere
     * 
     *
     * on va verifier si on doit placer la matiere premiere en debut de la liste des matieres premieres a traiter
	 * si l'un des oxydes ce trouve dans les materiaux plus complexes 
	 * et que l'autre n'est pas disponible seul
	 *				
	 * ordre de sortie
     * - matieres premieres avec oxyde non trouvable ailleur de la plus complexe à la plus simple
     * - matieres premieres de la plus complexe à la plus simple
     */

    private function ordonneMatieresPremieres(StockMatieresPremieres $stock):StockMatieresPremieres{
        // on cherche les ids d'oxyde des matieres premieres qui n'en n'on qu'un seul
        $arrIdOxydeDispoSolo =[];
        foreach($stock->getMatieresPremiere()->toArray() as $matierePremiere){
            if($matierePremiere->getOxydes()->length()==1){
                $collOxydes = $matierePremiere->getOxydes();
                $arrIdOxydeDispoSolo[]=$collOxydes->getCurrent()->getId();
            }
        }

        // on cherche les ids des matieres premieres qui possedent des oxydes non trouvable seul
        $arrIdMAtPremOxydeNonDispoSolo =[];
        foreach($stock->getMatieresPremiere()->toArray() as $matierePremiere){
            if($matierePremiere->getOxydes()->length()>1){
                $collOxydes = $matierePremiere->getOxydes();
                while ($oxyde = $collOxydes->getCurrent()) {
                    if(!in_array($oxyde->getId(),$arrIdOxydeDispoSolo)){
                        $arrIdMAtPremOxydeNonDispoSolo[]=$matierePremiere->getId();
                    }
                    $collOxydes->next();
                }
            }
        }

        // on cherche les ids des matieres premieres ordonner de la plus simple a la plus complexe
        $idMatPremOrdSimpleComplexe=[];
        $arrTemp=[];
        foreach($stock->getMatieresPremiere()->toArray() as $matierePremiere){
            $arrTemp[$matierePremiere->getOxydes()->length()][]=$matierePremiere->getId();
        }
        foreach($arrTemp as $arrIdMatPrem){
            foreach($arrIdMatPrem as $idMatPrem){
                $idMatPremOrdSimpleComplexe[]=$idMatPrem;
            }
        }

        //
        $stockRetour = new StockMatieresPremieres();
        foreach($idMatPremOrdSimpleComplexe as $idMat){
            foreach($stock->getMatieresPremiere()->toArray() as $matierePremiere){
                if($matierePremiere->getId()==$idMat){
                    if(!in_array($idMat,$arrIdMAtPremOxydeNonDispoSolo)){
                        $stockRetour->add($matierePremiere);
                    }else{
                        // on la place devand
                        $stockRetour->addBefore($matierePremiere);
                    }
                }
            }
        }
        return $stockRetour;
    }

    /**
     * @param FormuleSeger
     * return Recette
     */
    // public function toSeger(Recette $recette):?FormuleSeger
    // {
    //     return new FormuleSeger::constructeur();
    // }

 }


?>