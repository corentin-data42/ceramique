<?php
namespace Domain\Common\Object;
class Oxyde{
    protected ?int $id = null;
    protected ?string $nom = null;
    protected ?float $pm = null;
    protected ?string $formule = null;
    protected ?int $type = null;
    protected ?int $ordre = null;
    protected ?bool $actif = null;
    public function __construct(
        // int $id,
        // string $nom,
        // float $pm,
        // string $formule,
        // string $type,
        // int $ordre,
        // bool $actif
    )
    {
        // $this->id = $id;
        // $this->nom = $nom;
        // $this->pm = $pm;
        // $this->formule = $formule;
        // $this->type = $type;
        // $this->ordre = $ordre;
        // $this->actif = $actif;
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
    public function setOrdre(int $ordre):static {
        $this->ordre = $ordre;
        return $this;
    }
    public function setActif(bool $actif):static {
        $this->actif = $actif;
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
    public function getOrdre():int {
        return $this->ordre;
    }
    public function isActif():bool {
        return $this->actif;
    }
}
?>