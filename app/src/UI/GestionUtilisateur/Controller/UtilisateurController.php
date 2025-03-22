<?php declare(strict_types=1);

namespace UI\GestionUtilisateur\Controller;
use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Forms;

use UI\GestionUtilisateur\Adaptateur\GestionUtilisateurAdaptateur;
use UI\GestionUtilisateur\Form\UtilisateurCreateType;
use UI\GestionUtilisateur\DTO\Mapper\AjouteUtilisateurCommandMapper;


use App\RepositoryAdaptateur\RepositoryQueryAdaptateur;
use App\RepositoryAdaptateur\RepositoryCommandAdaptateur;

use Application\GestionUtilisateur\Command\AjouteUtilisateurCommand;
use Application\GestionUtilisateur\Handler\AjouteUtilisateurCommandHandler;


use App\Repository\UtilisateurRepository;

final class UtilisateurController extends AbstractController {

    #[Route('/utilisateur', name: 'utilisateur.index')]
    public function index(): Response
    {

        return $this->render('utilisateur/index.html.twig', [

        ]);
        
    }

    #[Route('/utilisateur/create', name: 'utilisateur.create')]
    public function create(Request $request, UtilisateurRepository $utilisateurRepository, UserPasswordHasherInterface $hasher): Response
    {   
        $repositoryQueryAdaptateur = new RepositoryQueryAdaptateur(
            utilisateurRepository:$utilisateurRepository,
        );
        $repositoryCommandAdaptateur = new RepositoryCommandAdaptateur(
            utilisateurRepository:$utilisateurRepository,
        );

        $adaptateur = GestionUtilisateurAdaptateur::getInstance($repositoryCommandAdaptateur,$repositoryQueryAdaptateur);
        
        $validator = Validation::createValidator();

        $formFactory = Forms::createFormFactoryBuilder()
                        ->addExtension(new HttpFoundationExtension())
                        ->addExtension(new ValidatorExtension($validator))
                        ->getFormFactory();
        $formBuilder = $formFactory->createBuilder(UtilisateurCreateType::class);
        
        $form = $formBuilder->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $requestParams = $request->get('utilisateur_create');
            
            $utilisateur = new Utilisateur();
            $utilisateur->setNom($requestParams['nom'])
                ->setEmail($requestParams['email'])
                ->setRoles($requestParams['roles'])
                ->setFlagEtat((bool) $requestParams['flagEtat'])
                ->setPassword($hasher->hashPassword($utilisateur,$requestParams['password']['first']));
           
            $mapper=new AjouteUtilisateurCommandMapper();

            $command = $mapper->utilisateurToCommandDTO($utilisateur);
           
            $adaptateur->ajouteUtilisateur($command);
        }

        return $this->render('utilisateur/create.html.twig', [
            'form'=>$form,
        ]);
    }
}

?>