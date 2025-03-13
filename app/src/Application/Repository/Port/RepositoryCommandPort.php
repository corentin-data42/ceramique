<?php

namespace Application\Repository\Port;

use Application\Repository\DTO\RepOxDTO;

interface RepositoryCommandPort
{
    public function saveOxyde(RepOxDTO $oxyde, bool $flush = false);
}
