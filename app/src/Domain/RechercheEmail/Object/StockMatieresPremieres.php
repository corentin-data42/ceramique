<?php
namespace Domain\RechercheEmail\Object;

use Domain\Common\Object\Collection;
use Domain\Common\Object\MatierePremiere;

// pas juste une collection car dans le futur je veux pouvoir l'associer a un utilisateur 

class StockMatieresPremieres{
    
    private ?Collection $matieresPremieres = null;
    
    public function __construct()
    {
        $this->matieresPremieres = new Collection();
    }
    public function getMatieresPremiere():Collection{
        return $this->matieresPremieres;
    }
    public function addMatierePremiere(MatierePremiere $matierePremiere):static
    {
        if(!$this->matieresPremieres->contains($matierePremiere)){
            $this->matieresPremieres->add($matierePremiere);
        }
        return $this;
    }
    public function removeMatierePremiere(MatierePremiere $matierePremiere):static
    {   
        if($this->matieresPremieres->contains($matierePremiere)){
            $this->matieresPremieres->remove($matierePremiere);
        }
        return $this;
    } 
}
?>