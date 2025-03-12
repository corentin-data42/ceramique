<?php

namespace Application\Repository\Port;

use Application\Repository\DTO\OxydeDTO;

interface RepositoryCommandPort
{
    public function saveOxyde(OxydeDTO $oxyde, bool $flush = false);
}
