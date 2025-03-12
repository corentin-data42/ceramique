<?php
namespace Application\RechercheEmail\Command;

// c'est un Objet DTO 
class FormuleSegerConversionRecetteCommand{
    private ?array $oxydes; // [idOxyde=>quantité]
    
    public function __construct()
    {
        $this->oxydes = [];
    }
    /**
     * param $oxydes[id=>quantite]
     */
    public function setOxydes(array $oxydes):self
    {
        $this->oxydes = $oxydes;
        return $this;
    }
    public function getOxydes():array
    {
        return $this->oxydes;
    }
}
?>