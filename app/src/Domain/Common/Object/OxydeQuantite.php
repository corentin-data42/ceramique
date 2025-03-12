<?php
namespace Domain\Common\Object;

use Domain\Common\Object\Oxyde;

class OxydeQuantite extends Oxyde{
    
    protected ?float $quantite = null;
    
    public function __construct()
    {
    }
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