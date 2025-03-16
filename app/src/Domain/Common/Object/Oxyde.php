<?php
namespace Domain\Common\Object;
class Oxyde{
    protected ?int $id = null;
    protected ?string $nom = null;
    protected ?float $pm = null;
    protected ?string $formule = null;
    protected ?int $type = null;
    protected ?int $ordre = null;
    protected ?float $quantite = null;
    protected ?bool $flagEtat = null;
    public function __construct(

    )
    {

    }

    public function setId(int $id):static {
        $this->id = $id;
        return $this;
    }
    public function setNom(string $nom):static {
        $this->nom = $nom;
        return $this;
    }
    public function setPm(float $pm):static {
        $this->pm = $pm;
        return $this;
    }
    public function setFormule(string $formule):static {
        $this->formule = $formule;
        return $this;
    }
    public function setType(int $type):static {
        $this->type = $type;
        return $this;
    }
    public function setOrdre(?int $ordre=0):static {
        $this->ordre = $ordre;
        return $this;
    }
    public function setFlagEtat(bool $flagEtat):static {
        $this->flagEtat = $flagEtat;
        return $this;
    }

    public function getId():int {
        return $this->id;
    }
    public function getNom():string {
        return $this->nom;
    }
    public function getPm():float {
        return $this->pm;
    }
    public function getFormule():string {
        return $this->formule;
    }
    public function getType():int {
        return $this->type;
    }
    public function getOrdre():?int {
        return $this->ordre;
    }
    public function getFlagEtat():bool {
        return $this->flagEtat;
    }
    public function setQuantite(?float $quantite):static
    {
        $this->quantite = $quantite;
        return $this;
    }
    public function getQuantite():?float
    {
        return $this->quantite;
    }
}
?>