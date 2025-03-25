<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\MatierePremiere;
use App\Repository\MatierePremiereRepository;
use App\Form\MatierePremiereType;

use Symfony\Component\Security\Http\Attribute\IsGranted;
#[IsGranted('ROLE_ADMIN', message: 'You are not allowed to access the admin dashboard.')]
final class MatierePremiereController extends AbstractController
{
    #[Route('/admin/matiere-premiere', name: 'admin.matiere_premiere.index', methods:['GET'])]
    public function index(MatierePremiereRepository $repository): Response
    {
        $matieresPremieres = $repository->findAll();
        return $this->render('admin/matiere_premiere/index.html.twig',[
            'matierespremieres'=>$matieresPremieres
        ]);
    }

    #[Route('/admin/matiere-premiere/create', name: 'admin.matiere_premiere.create', methods:['POST','GET'])]
    public function create(Request $request, EntityManagerInterface $em): Response{
        $matierePremiere = new MatierePremiere();
        $form = $this->createForm(MatierePremiereType::class,$matierePremiere);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($matierePremiere);
            $em->flush();
            $this->addFlash('success','la matière première "'.$matierePremiere->getNom().'" à bien été créée');
            return $this->redirectToRoute('admin.matiere_premiere.index');
        }elseif($form->isSubmitted()){
            $this->addFlash('error','la matière première n\'a pas été créée');
        }
        
        return $this->render("admin/matiere_premiere/create.html.twig",[
            "form"=>$form
        ]);
    }

    #[Route("/admin/matiere-premiere/{id}/edit",name:"admin.matiere_premiere.edit", requirements:['id'=>'\d+'], methods:['POST','GET'])]
    public function edit(MatierePremiere $matierePremiere, Request $request, EntityManagerInterface $em): Response {
        $form = $this->createForm(MatierePremiereType::class,$matierePremiere);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            $this->addFlash('success','la matière première "'.$matierePremiere->getNom().'" à bien été modifiée');
            return $this->redirectToRoute('admin.matiere_premiere.index');
        }elseif($form->isSubmitted()){
            $this->addFlash('error','la matière première n\'a pas été modifiée');
            //dd($form->getErrors(true));
        }
        return $this->render("admin/matiere_premiere/edit.html.twig",[
            "matierepremiere"=>$matierePremiere,
            "form"=>$form
        ]);
    }  

    #[Route('/admin/matiere-premiere/{id}/remove', name: 'admin.matiere_premiere.remove', requirements:['id'=>'\d+'], methods:['DELETE'])]
    public function remove(MatierePremiere $matierePremiere, EntityManagerInterface $em): Response
    {
        $em->remove($matierePremiere);
        $em->flush();
        $this->addFlash('success',$matierePremiere->getNom().' bien été supprimé');
        return $this->redirectToRoute('admin.matiere_premiere.index');
    }

    #[Route('/admin/matiere-premiere/{id}', name: 'admin.matiere_premiere.show', requirements:['id'=>'\d+'])]
    public function show(Request $request, int $id): Response
    {
        return $this->render('admin/matiere_premiere/show.html.twig',['id'=>$id]);
    } 
}
