<?php

namespace UI\RechercheEmail\Controller;

use UI\RechercheEmail\Adaptateur\RechercheEmailAdaptateur;
use UI\RechercheEmail\Form\FormuleSegerType;
use UI\RechercheEmail\DTO\Mapper\FormuleSegerConversionRecetteCommandMapper;



use App\RepositoryAdaptateur\RepositoryQueryAdaptateur;
use App\RepositoryAdaptateur\RepositoryCommandAdaptateur;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Forms;

use Application\RechercheEmail\Query\GetAllOxydeActifQuery;
use Application\RechercheEmail\Command\FormuleSegerConversionRecetteCommand;

use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;


final class RechercheEmailController extends AbstractController
{
    private $adaptateur;
    public function __construct(
        RepositoryQueryAdaptateur $repositoryQueryAdaptateur,
        RepositoryCommandAdaptateur $repositoryCommandAdaptateur
    )
    {
        $this->adaptateur = RechercheEmailAdaptateur::getInstance($repositoryCommandAdaptateur,$repositoryQueryAdaptateur);
        
    }
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
            FormFactoryInterface $formFactory,
        ):Response{
        
        $formBuilder = $formFactory->createBuilder(FormuleSegerType::class);
        
        $form = $formBuilder->getForm();
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            
            $mapper=new FormuleSegerConversionRecetteCommandMapper();

            $command = $mapper->requestToCommandDTO($request);

            $this->adaptateur->convSegerRecette($command);

        }elseif($form->isSubmitted()){
            $this->addFlash('danger',$form->getErrors(true)->offsetGet(0)->getMessage());
        }
        

        return $this->render("recherche_email/convertion-formule-recette.html.twig",[
            "form"=>$form
        ]);
    }
}
