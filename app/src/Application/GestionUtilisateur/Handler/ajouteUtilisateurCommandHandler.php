<?php declare(strict_types=1);

    namespace Application\GestionUtilisateur\Handler;
    use Domain\Common\Object\Utilisateur;
    use Application\GestionUtilisateur\Port\GestionUtilisateurPort;
    use Application\GestionUtilisateur\Command\AjouteUtilisateurCommand;

    use Application\GestionUtilisateur\DTO\AjouteUtilisateurCommandMapper;
    //use Application\Repository\Command\;
    use Application\Repository\Handler\GetSegerMatPremQueryHandler;
    use Application\Repository\Handler\CreateUtilisateurCommandHandler;
    use Application\Repository\Command\CreateUtilisateurCommand;

    class AjouteUtilisateurCommandHandler{
        public function __construct(
            protected GestionUtilisateurPort $gestionUtilisateurPort
        ) {

        }
        public function handle(AjouteUtilisateurCommand $command){
            
            //$newUtilisateur =  AjouteUtilisateurCommandMapper::fromDTO($command);
            //dd($newUtilisateur);
            $commandRep = new CreateUtilisateurCommand(
                $command->getNom(),
                $command->getEmail(),
                $command->getPassword(),
                $command->getRoles(),
                $command->getFlagEtat()
            );
            $handler = new CreateUtilisateurCommandHandler($this->gestionUtilisateurPort->repositoryCommandPort);
            $handler->handle($commandRep);
            dd();
            
        }
    }
?>