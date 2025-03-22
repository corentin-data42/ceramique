<?php

namespace Application\Repository\Port;

use Application\Repository\DTO\RepOxDTO;
use Application\Repository\DTO\RepUtilisateurDTO;

interface RepositoryCommandPort
{
    public function saveOxyde(RepOxDTO $oxyde, bool $flush = false);
    public function ajouteUtilisateur(RepUtilisateurDTO $utilisateur, bool $flush = false);
}
