<?php

namespace UI\RechercheEmail\Controller;

use UI\RechercheEmail\Adaptateur\RechercheEmailAdaptateur;
use UI\RechercheEmail\Form\FormuleSegerType;
use UI\RechercheEmail\DTO\Mapper\FormuleSegerConversionRecetteCommandMapper;

use App\Repository\OxydeRepository;
use App\Repository\MatierePremiereRepository;
use App\Repository\MatierePremiereOxydeQuantiteRepository;
use App\RepositoryAdaptateur\RepositoryQueryAdaptateur;
use App\RepositoryAdaptateur\RepositoryCommandAdaptateur;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;

use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Forms;

use Application\RechercheEmail\Query\GetAllOxydeActifQuery;
use Application\RechercheEmail\Command\FormuleSegerConversionRecetteCommand;

use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;


final class RechercheEmailController extends AbstractController
{
    #[Route('/recherche-email', name: 'recherche-email.index')]
    public function index(): Response
    {
        return $this->render('recherche_email/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
    #[Route('/recherche-email/conversion-formule-seger-recette', name: 'recherche-email.conv-seger-recette')]
    public function convSegerRecette(
            Request $request, 
            OxydeRepository $oxydeRepository,
            MatierePremiereRepository $matierePremiereRepository , 
            MatierePremiereOxydeQuantiteRepository $matierePremiereOxydeQuantiteRepository
            
            
        ):Response{
        /* 
            initialisation des repository[Query/Command]adaptateur
            qui utilisent les interfaces repository[Query/Command]Port 
            definies dans la couche application
        */
        $repositoryQueryAdaptateur = new RepositoryQueryAdaptateur(
            $oxydeRepository,
            $matierePremiereRepository,
            $matierePremiereOxydeQuantiteRepository
        );
        $repositoryCommandAdaptateur = new RepositoryCommandAdaptateur(
            $oxydeRepository,
            $matierePremiereRepository,
            $matierePremiereOxydeQuantiteRepository
        );

        /* 
            initialisation de RechercheEmailAdaptateur
            qui utilise l'interfaces RechercheEmailPort 
            definies dans la couche application
        */
        $adaptateur = RechercheEmailAdaptateur::getInstance($repositoryCommandAdaptateur,$repositoryQueryAdaptateur);
        
        $validator = Validation::createValidator();

        $formFactory = Forms::createFormFactoryBuilder()
                        ->addExtension(new HttpFoundationExtension())
                        ->addExtension(new ValidatorExtension($validator))
                        ->getFormFactory();
        $formBuilder = $formFactory->createBuilder(FormuleSegerType::class);
        
        $form = $formBuilder->getForm();
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){   
            //$command = new FormuleSegerConversionRecetteCommand();
            // construction de la command
            
            $mapper=new FormuleSegerConversionRecetteCommandMapper();
            $command = $mapper->requestToCommandDTO($request);
            $adaptateur->convSegerRecette($command);
        }elseif($form->isSubmitted()){
            $this->addFlash('error','erreur');
        }
        

        return $this->render("recherche_email/convertion-formule-recette.html.twig",[
            "form"=>$form
        ]);
    }
}
