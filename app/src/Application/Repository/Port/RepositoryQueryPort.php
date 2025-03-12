<?php

namespace Application\Repository\Port;

use Application\Repository\DTO\OxydeDTO;

interface RepositoryQueryPort
{
    public function getOneOxydeById(int $id);
    public function getAllOxydeActif():array;
    public function getAllOxydeActifOrderByType():array;
}
