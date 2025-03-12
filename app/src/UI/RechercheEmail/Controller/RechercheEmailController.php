<?php

namespace App\UI\RechercheEmail\Controller;

use App\UI\RechercheEmail\Adaptateur\RechercheEmailAdaptateur;
use App\UI\RechercheEmail\Form\FormuleSegerType;
use App\UI\RechercheEmail\DTO\Mapper\FormuleSegerConversionRecetteCommandMapper;

use App\Repository\DoctrineOxydeRepository;
use App\Repository\DoctrineMatierePremiereRepository;
use App\Repository\DoctrineMatierePremiereOxydeRepository;
use App\Repository\RepositoryQueryAdaptateur;
use App\Repository\RepositoryCommandAdaptateur;

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
            DoctrineOxydeRepository $oxydeRepository,
            DoctrineMatierePremiereRepository $matierePremiereRepository , 
            DoctrineMatierePremiereOxydeRepository $matierePremiereOxyde
            
            
        ):Response{
        $repositoryQueryPort = new RepositoryQueryAdaptateur(
            $oxydeRepository,
            $matierePremiereRepository,
            $matierePremiereOxyde
        );
        $repositoryCommandPort = new RepositoryCommandAdaptateur(
            $oxydeRepository,
            $matierePremiereRepository,
            $matierePremiereOxyde
        );
       
        $adaptateur = RechercheEmailAdaptateur::getInstance($repositoryCommandPort,$repositoryQueryPort);
        
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
        }
        

        return $this->render("recherche_email/convertion-formule-recette.html.twig",[
            "form"=>$form
        ]);
    }
}
