<?php
namespace Domain\RechercheEmail\Object;

use Domain\Common\Object\Collection;
use Domain\Common\Object\MatierePremiere;

// pas juste une collection car dans le futur je veux pouvoir l'associer a un utilisateur 

class StockMatieresPremieres{
    
    protected ?Collection $matieresPremieres = null;
    
    public function __construct()
    {
        $this->matieresPremieres = new Collection();
    }
    /**
     * return Collection
     */
    public function getMatieresPremiere():Collection{
        return $this->matieresPremieres;
    }
    /**
     * @matierePremiere MatierePremiere
     * return Static
     */
    public function add(MatierePremiere $matierePremiere, $before=false):static
    {
        if(!$this->matieresPremieres->contains($matierePremiere)){
            $this->matieresPremieres->add($matierePremiere, unshift:$before);
        }
        return $this;
    }

    /**
     * @matierePremiere MatierePremiere
     * return Static
     */
    public function remove(MatierePremiere $matierePremiere):static
    {   
        if($this->matieresPremieres->contains($matierePremiere)){
            $this->matieresPremieres->remove($matierePremiere);
        }
        return $this;
    } 
}
?>