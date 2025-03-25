<?php 

namespace UI\GestionUtilisateur\Controller;

use App\Entity\Utilisateur;

use App\RepositoryAdaptateur\RepositoryQueryAdaptateur;
use App\RepositoryAdaptateur\RepositoryCommandAdaptateur;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\FormFactoryInterface;


use UI\GestionUtilisateur\Adaptateur\GestionUtilisateurAdaptateur;
use UI\GestionUtilisateur\Form\UtilisateurCreateType;

use Application\GestionUtilisateur\Command\AjouteUtilisateurCommand;
use UI\GestionUtilisateur\DTO\UtilisateurDTO;

use Symfony\Component\Security\Http\Attribute\IsGranted;
#[IsGranted('ROLE_ADMIN', message: 'You are not allowed to access the admin dashboard.')]
final class UtilisateurController extends AbstractController {

    private $adaptateur;
    public function __construct(
        RepositoryQueryAdaptateur $repositoryQueryAdaptateur,
        RepositoryCommandAdaptateur $repositoryCommandAdaptateur
    )
    {
        
        
        
        $this->adaptateur = GestionUtilisateurAdaptateur::getInstance($repositoryCommandAdaptateur,$repositoryQueryAdaptateur);
    }
    public function __invoke(){
        
    }


    #[Route('/admin/utilisateur', name: 'uiadmin.utilisateur.index')]
    public function index(): Response
    {
        return $this->render('utilisateur/index.html.twig', [

        ]);
        
    }

    #[Route('/admin/utilisateur/create', name: 'uiadmin.utilisateur.create')]
    public function create(
        Request $request,
        UserPasswordHasherInterface $hasher,
        FormFactoryInterface $formFactory,
     ): Response
    {   
        $uDto = new UtilisateurDTO();
        $formBuilder = $formFactory->createBuilder(UtilisateurCreateType::class,$uDto);
        
        $form = $formBuilder->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dd($uDto);
            $requestParams = $request->get('utilisateur_create');
            $uDto->setPassword($hasher->hashPassword(new Utilisateur(),$requestParams['password']['first']));
            
            $command = new AjouteUtilisateurCommand(
                $uDto->getNom(),
                $uDto->getPassword(),
                $uDto->getEmail(),
                $uDto->getRoles(),
                $uDto->getFlagEtat(),
            );
            try{
                $this->adaptateur->ajouteUtilisateur($command);
            }catch( \Exception $e){
                //UniqueConstraintViolationException
                $this->addFlash('danger','erreur creation utilisateur');
                return $this->redirectToRoute('utilisateur.create');
            }
        }
        
        return $this->render('utilisateur/create.html.twig', [
            'form'=>$form,
        ]);
    }
}

?>