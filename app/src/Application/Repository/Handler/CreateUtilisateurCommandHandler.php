<?php
    namespace Application\Repository\Handler;

    use Application\Repository\Command\CreateUtilisateurCommand;
    use Application\Repository\Port\RepositoryCommandPort;
    use Application\Repository\DTO\RepUtilisateurDTO;
    use Application\Repository\DTO\RepUtilisateurDTOMapper;

    class CreateUtilisateurCommandHandler{

        public function __construct(
            protected RepositoryCommandPort $databasePort
        ){   
        }

         public function handle(CreateUtilisateurCommand $command):void{
            

            $RepUtilisateurDTO = RepUtilisateurDTOMapper::createCommandToDTO($command);
            
            $this->databasePort->ajouteUtilisateur($RepUtilisateurDTO, true);
           
        }
    }