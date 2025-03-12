<?php
namespace Domain\RechercheEmail\Object;

use Domain\Common\Object\Collection;
use Domain\RechercheEmail\Object\RecetteMatierePremiere;

class Recette{
    
    private ?int $id = null;
    private ?Collection $matieresPremieres = null;

    public function  __construct()
    {
        $this->matieresPremieres = new Collection();
    }

    public function setId(int $id):static
    {
        $this->id = $id;
        return $this;
    }
    public function getId():int{
        return $this->id;
    }
    public function getMatieresPremieres():Collection{
        return $this->matieresPremieres;
    }
    public function setMatieresPremieres(Collection $matieresPremieres):static
    {
        $this->matieresPremieres=$matieresPremieres;
        return $this;
    }
    public function addMatierePremiere(RecetteMatierePremiere $matierePremiere):static
    {
        if(!$this->matieresPremieres->contains($matierePremiere)){
            $this->matieresPremieres->add($matierePremiere);
        }
        return $this;
    }
    public function removeMatierePremiere(RecetteMatierePremiere $matierePremiere):static
    {   
        if($this->matieresPremieres->contains($matierePremiere)){
            $this->matieresPremieres->remove($matierePremiere);
        }
        return $this;
    }

}

?>