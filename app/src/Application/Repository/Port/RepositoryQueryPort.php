<?php

namespace Application\Repository\Port;

use Application\Repository\DTO\OxydeDTO;

interface RepositoryQueryPort
{
    public function getOneOxydeById(int $id);
    public function getOxydeById(array $arrId,?bool $actifOnly):array;
    public function getMatPremByIdOxyde (array $arrId,?bool $activeOnly):array;
    public function getAllOxydeActif():array;
    public function getAllOxydeActifOrderByType():array;
}
