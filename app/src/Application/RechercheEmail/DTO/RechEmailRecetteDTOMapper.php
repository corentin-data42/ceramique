<?php namespace Application\RechercheEmail\DTO;

use Domain\RechercheEmail\Object\Recette;

use Application\RechercheEmail\DTO\RechEmailRecetteDTO;

class RechEmailRecetteDTOMapper{
    public static function toDTO(Recette $recette) {
        $dto = new RechEmailRecetteDTO();
        $dto->setId($recette->getId());
        return $recette;
    }
    public static function fromDTO(RechEmailRecetteDTO $dto):Recette {
        $recette = new Recette();
        $recette->setId($dto->getId());

        return $recette;
    }
}

?>