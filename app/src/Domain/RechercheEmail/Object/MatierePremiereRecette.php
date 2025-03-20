<?php 
namespace Domain\RechercheEmail\Object;

use Domain\Common\Object\MatierePremiere;

class MatierePremiereRecette extends MatierePremiere{

    protected ?float $quantite = null;
    
    public function setQuantite(float $quantite):static
    {
        $this->quantite = $quantite;
        return $this;
    }
    public function getQuantite():float
    {
        return $this->quantite;
    }
}

?>